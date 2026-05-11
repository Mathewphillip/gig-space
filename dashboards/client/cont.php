<div class="messages">
    <?php
    $user_id = $_SESSION['user_id'];

    // fetch conversations involving this user (as client)
    $convo_query = "
        SELECT 
            conversations.id,
            orders.id AS order_id,
            gigs.title AS gig_title
        FROM conversations
        JOIN orders ON conversations.order_id = orders.id
        JOIN gigs ON orders.gig_id = gigs.id
        WHERE orders.client_id = $user_id
        ORDER BY conversations.updated_at DESC
    ";
    $convo_result = mysqli_query($conn, $convo_query);

    // get selected conversation (default: first)
    $selected_convo_id = $_GET['convo'] ?? null;
    ?>

    <div class="panel messages-panel">
        <div class="messages-container">
            <div class="conversations">
                <h3>Messages</h3>
                <?php if (mysqli_num_rows($convo_result) > 0): ?>
                    <?php while ($convo = mysqli_fetch_assoc($convo_result)): ?>
                        <a href="#" class="conversation-item" data-id="<?php echo $convo['id']; ?>" onclick="loadConversation(<?php echo $convo['id']; ?>, '<?php echo htmlspecialchars($convo['gig_title'], ENT_QUOTES); ?>')">
                            <div>
                                <strong><?php echo htmlspecialchars($convo['gig_title']); ?></strong>
                                <p>Order #<?php echo $convo['order_id']; ?></p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div style="padding: 20px; text-align: center; color: #666;">
                        <p style="font-size: 14px; margin-bottom: 10px;">📭 No conversations yet.</p>
                        <p style="font-size: 12px;">Start by placing an order from Browse Gigs!</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="chat-area">
                <div class="chat-header">
                    <h4 id="chatTitle">Select a conversation</h4>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <p class="empty-chat">No messages selected</p>
                </div>
                <div class="chat-input">
                    <input type="text" id="messageInput" placeholder="Type a message..." disabled>
                    <button id="sendBtn" onclick="sendMessage()" disabled>Send</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        let currentConvoId = null;
        let currentGigTitle = '';

        function loadConversation(convoId, gigTitle) {
            currentConvoId = convoId;
            currentGigTitle = gigTitle;

            document.getElementById('chatTitle').innerText = gigTitle;
            document.getElementById('messageInput').disabled = false;
            document.getElementById('sendBtn').disabled = false;
            document.getElementById('chatMessages').innerHTML = '<p class="empty-chat">Loading messages ...</p>';

            // Highlight selected conversation
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.style.background = '';
            });
            document.querySelector('.conversation-item[data-id="' + convoId + '"]').style.background = '#e5e7eb';

            fetch('../process/get_messages.php?convo_id=' + convoId)
                .then(r => {
                    if (!r.ok) throw new Error('Failed to load messages');
                    return r.json();
                })
                .then(data => {
                    if (data.error) {
                        document.getElementById('chatMessages').innerHTML = '<p class="empty-chat">' + data.error + '</p>';
                        return;
                    }
                    renderMessages(data.messages);
                })
                .catch(err => {
                    document.getElementById('chatMessages').innerHTML = '<p class="empty-chat" style="color:red;">' + err.message + '</p>';
                });
        }

        function renderMessages(messages) {
            const container = document.getElementById('chatMessages');
            if (messages.length === 0) {
                container.innerHTML = '<p class="empty-chat">No messages yet. Start the conversation!</p>';
                return;
            }
            container.innerHTML = '';
            messages.forEach(msg => {
                const div = document.createElement('div');
                div.className = 'message-bubble ' + (msg.is_me ? 'message-me' : 'message-them');
                div.innerHTML = '<strong>' + escapeHtml(msg.sender_name) + '</strong><p>' + escapeHtml(msg.message) + '</p><small>' + msg.created_at + '</small>';
                container.appendChild(div);
            });
            container.scrollTop = container.scrollHeight;
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            if (!message || !currentConvoId) return;

            const formData = new FormData();
            formData.append('convo_id', currentConvoId);
            formData.append('message', message);

            fetch('../process/send_message.php', {
                    method: 'POST',
                    body: formData
                })
                .then(r => {
                    if (!r.ok) throw new Error('Failed to send');
                    return r.json();
                })
                .then(data => {
                    if (data.success) {
                        input.value = '';
                        loadConversation(currentConvoId, currentGigTitle);
                    } else {
                        alert(data.error || 'Failed to send message');
                    }
                })
                .catch(err => {
                    alert(err.message);
                });
        }

        // Send on Enter key
        document.getElementById('messageInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Auto-open conversation if redirected from orders page
        document.addEventListener('DOMContentLoaded', function() {
            const openConvo = localStorage.getItem('open_convo');
            const openTitle = localStorage.getItem('open_title');
            if (openConvo && openTitle) {
                loadConversation(parseInt(openConvo), openTitle);
                localStorage.removeItem('open_convo');
                localStorage.removeItem('open_title');
            }
        });
    </script>

    <style>
        .message-bubble {
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 10px;
            max-width: 75%;
            word-wrap: break-word;
        }

        .message-me {
            background: #4f46e5;
            color: #fff;
            margin-left: auto;
            text-align: right;
        }

        .message-me strong,
        .message-me small {
            color: #e0e7ff;
        }

        .message-them {
            background: #f3f4f6;
            color: #111827;
            margin-right: auto;
        }

        .message-bubble strong {
            display: block;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .message-bubble p {
            margin: 0 0 4px 0;
            font-size: 14px;
        }

        .message-bubble small {
            font-size: 11px;
            opacity: 0.8;
        }
    </style>


</div>

