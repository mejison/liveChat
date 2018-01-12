<template lang="html">
    <div class="media">
        <div class="media-left">
            <img src="//placehold.it/50" alt="user" class="img-circle" />
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{ message.user.name }} <small>{{ message.created_at | formatDate }}</small></h4>
            <p v-show=" ! message.is_code">
                {{ message.message }}
            </p>
            <pre v-show="message.is_code">
                <code>
                    {{ message.message }}
                </code>
            </pre>
            <p v-show="message.attach">
                <i class="fa fa-paperclip"></i>
                <a download :href=" '/storage/' + message.attach.replace('public/', '') ">{{ message.attach }}</a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>