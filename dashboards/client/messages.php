<?php
$user_id = $_SESSION['user_id'];

// fetch conversations involving this user (as client) - support project orders
$convo_query = "
    SELECT 
        conversations.id,
        orders.id AS order_id,
        COALESCE(gigs.title, CONCAT('Project: ', projects.title)) AS convo_title
    FROM conversations
    JOIN orders ON conversations.order_id = orders.id
    LEFT JOIN gigs ON orders.gig_id = gigs.id
    LEFT JOIN projects ON orders.project_id = projects.id
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
            <?php if(mysqli_num_rows($convo_result) > 0): ?>
                <?php while($convo = mysqli_fetch_assoc($convo_result)): ?>
                    <a href="javascript:void(0);" class="conversation-item" data-id="<?php echo $convo['id']; ?>" onclick="loadConversation(<?php echo $convo['id']; ?>, '<?php echo htmlspecialchars($convo['convo_title'], ENT_QUOTES); ?>')">
                        <div>
                            <p class="message-topic"><?php echo htmlspecialchars($convo['convo_title']); ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="padding: 20px; text-align: center; color: #666;">
                    <p style="font-size: 14px; margin-bottom: 10px;">No conversations yet. Accept a bid or make an order.</p>
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
let lastMessageId = 0;
let pollInterval = null;
let isSending = false;
let sendTimeout = null;
let sendingOptimisticId = null;

function loadConversation(convoId, gigTitle) {
    stopPolling();
    currentConvoId = convoId;
    currentGigTitle = gigTitle;
    lastMessageId = 0;

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
            if(!r.ok) throw new Error('Failed to load messages');
            return r.json();
        })
        .then(data => {
            if(data.error){
                document.getElementById('chatMessages').innerHTML = '<p class="empty-chat">' + data.error + '</p>';
                return;
            }
            renderMessages(data.messages);
            startPolling();
        })
        .catch(err => {
            document.getElementById('chatMessages').innerHTML = '<p class="empty-chat" style="color:red;">' + err.message + '</p>';
        });
}

function renderMessages(messages) {
    const container = document.getElementById('chatMessages');
    if(messages.length === 0){
        container.innerHTML = '<p class="empty-chat">No messages yet. Start the conversation!</p>';
        return;
    }
    container.innerHTML = '';
    messages.forEach(msg => {
        const div = createMessageBubble(msg);
        container.appendChild(div);
        if(msg.id > lastMessageId) lastMessageId = msg.id;
    });
    container.scrollTop = container.scrollHeight;
}

function appendMessages(messages) {
    const container = document.getElementById('chatMessages');
    if(messages.length === 0) return;

    const empty = container.querySelector('.empty-chat');
    if(empty) empty.remove();

    let shouldScroll = (container.scrollTop + container.clientHeight >= container.scrollHeight - 20);

    messages.forEach(msg => {
        const div = createMessageBubble(msg);
        container.appendChild(div);
        if(msg.id > lastMessageId) lastMessageId = msg.id;
    });

    if(shouldScroll) {
        container.scrollTop = container.scrollHeight;
    }
}

function createMessageBubble(msg) {
    const div = document.createElement('div');
    div.className = 'message-bubble ' + (msg.is_me ? 'message-me' : 'message-them') + (msg.id === sendingOptimisticId ? ' sending' : '');
    div.setAttribute('data-msg-id', msg.id);
    div.innerHTML = '<strong>' + escapeHtml(msg.sender_name) + '</strong><p>' + escapeHtml(msg.message) + '</p><small>' + msg.created_at + '</small>';
    return div;
}

function startPolling() {
    stopPolling();
    if (isSending) return; // Don't poll while sending
    pollInterval = setInterval(() => {
        if(!currentConvoId || isSending) return;
        fetch('../process/get_messages.php?convo_id=' + currentConvoId + '&after_id=' + lastMessageId)
            .then(r => r.json())
            .then(data => {
                if(data.error) {
                    console.warn('Poll error:', data.error);
                    return;
                }
                if(data.messages && data.messages.length > 0){
                    appendMessages(data.messages);
                }
            })
            .catch(err => console.error('Poll failed:', err));
    }, 4000); // Slightly longer interval
}

function stopPolling() {
    if(pollInterval) {
        clearInterval(pollInterval);
        pollInterval = null;
    }
}

function debounceSend() {
    if (sendTimeout) clearTimeout(sendTimeout);
    sendTimeout = setTimeout(sendMessage, 300);
}

function sendMessage() {
    if (isSending) return;
    
    const input = document.getElementById('messageInput');
    const message = input.value.trim();
    if(!message || !currentConvoId) return;

    isSending = true;
    input.disabled = true;
    document.getElementById('sendBtn').disabled = true;
    input.value = '';

    // Optimistic bubble
    sendingOptimisticId = Date.now();
    const optimisticMsg = {
        id: sendingOptimisticId,
        sender_name: '<?php echo $_SESSION["username"] ?? "You"; ?>',
        message: message,
        created_at: new Date().toLocaleTimeString(),
        is_me: true
    };
    appendMessages([optimisticMsg]);
    stopPolling(); // Pause poll during send

    const formData = new FormData();
    formData.append('convo_id', currentConvoId);
    formData.append('message', message);

    fetch('../process/send_message.php', {
        method: 'POST',
        body: formData
    })
    .then(r => {
        if(!r.ok) throw new Error('Network error');
        return r.json();
    })
    .then(data => {
        if(data.success){
            console.log('Message sent, id:', data.message_id);
            // Remove optimistic if needed, but refetch will update
        } else {
            console.error('Send failed:', data.error);
            // Remove optimistic bubble
            const bubble = document.querySelector(`[data-msg-id="${sendingOptimisticId}"]`);
            if (bubble) bubble.remove();
            alert('Failed to send: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(err => {
        console.error('Send error:', err);
        // Remove optimistic
        const bubble = document.querySelector(`[data-msg-id="${sendingOptimisticId}"]`);
        if (bubble) bubble.remove();
        alert('Send failed: ' + err.message);
    })
    .finally(() => {
        isSending = false;
        input.disabled = false;
        document.getElementById('sendBtn').disabled = false;
        startPolling(); // Resume poll
        sendingOptimisticId = null;
        if (sendTimeout) clearTimeout(sendTimeout);
    });
}

// Send on Enter key - debounced
document.getElementById('messageInput').addEventListener('keypress', function(e) {
    if(e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        debounceSend();
    }
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
    if(openConvo && openTitle) {
        loadConversation(parseInt(openConvo), openTitle);
        localStorage.removeItem('open_convo');
        localStorage.removeItem('open_title');
    }
});
</script>

<style>
.message-topic{
font-weight: 400;
}
.message-bubble {
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 10px;
    max-width: 50%;
    word-wrap: break-word;
}
.message-me {
    background: #020031;
    color: #fff;
    margin-left: auto;
    text-align: right;
}
.message-me strong, .message-me small {
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
    font-weight: 450;
    margin-bottom: 10px;
}
.message-bubble p {
    margin: 0 0 4px 0;
    font-size: 14px;
    font-weight: 400;
}
.message-bubble small {
    font-size: 11px;
    opacity: 0.8;
}
</style>

