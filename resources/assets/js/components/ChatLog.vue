<template lang="html">
    <div class="chat-log">
        <chat-message v-for="message in messages" :message="message" :key="message.id"></chat-message>
        <div class="empty" v-show="messages.length === 0">
            Nothing here yet!
        </div>
    </div>
</template>

<script>
export default {
    props: ['messages']
}
</script>