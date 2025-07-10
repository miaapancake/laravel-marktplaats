import './bootstrap';

const notification = new Audio("/notification.wav");

function listenForChatMessages(chatId) {
    console.debug(`Listening for chat messages in chat: ${chatId}`);

    Echo.private(`chats.${chatId}`)
        .listen('ChatMessageSent', (e) => {
            htmx.ajax('GET', `/messages/${e.message.id}`, { target: '#messages', swap: 'beforeend' }).then(() => {
                notification.play();
            });
        });
}

document.addEventListener("DOMContentLoaded", () => {
    const CHAT_ID = document.querySelector("meta[name='chat_id']").getAttribute('content');
    listenForChatMessages(CHAT_ID);
});
