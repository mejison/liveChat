<template lang="html">
    <div class="row">
        <div class="col-xs-10">
            <div class="input-group input-group">
                <input autofocus type="text" class="form-control" v-model="messageText" @keyup.enter="sendMessage" />
                <span class="input-group-addon wrapper-zone">
                    <i class="fa fa-paperclip"></i>
                    <input type="file" @change="attachFile($event)" class="zone" />
                </span>
                <span class="input-group-addon" @click="attachCode()">
                    <i class="fa fa-code"></i>
                </span>
            </div>
        </div>
        <div class="col-xs-2">
            <button class="btn btn-primary btn-block" @click="sendMessage">
                Send
            </button>
        </div>

        <div class="modal fade" tabindex="-1" id="attachCodeModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create snippet</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" v-model="codeSnippet"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addCodeSnippet()">Create Snippet</button>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                messageText : '',
                attach: '',
                is_code : false,
                codeSnippet : '',
                user : {}
            }
        },
        created() {
            this.getUser();
        },
        methods: {
            sendMessage() {
                let mainData = this;
                console.log(mainData.user);
                mainData.$emit('messagesent', {
                    message : mainData.messageText,
                    user : {
                        name: mainData.user.name
                    },
                    attach : mainData.attach,
                    created_at : new Date(),
                    is_code : mainData.is_code
                });
                mainData.messageText = "";
                mainData.attach = "";
                mainData.is_code = false;
            },
            getUser() {
                let mainData = this;
                axios.get('/api/user').then((res) => {
                    mainData.user = res.data;
                });
            },
            attachFile(event) {
                let fd = new FormData(),
                    mainData = this;

                fd.append("file", event.target.files[0]);
                axios.post('/api/attachFile', fd).then((response) => {
                    mainData.attach = response.data.path;
                    mainData.sendMessage();
                });
            },
            attachCode() {
                $("#attachCodeModal").modal("show");
            },
            addCodeSnippet() {
                this.messageText = this.codeSnippet;
                this.codeSnippet = "";
                this.is_code = true;
                this.sendMessage();
            }
        }
    }
</script>

<style>
    .wrapper-zone {
        position: relative;
        overflow: hidden;
        z-index: 0;
    }

    .zone {
        opacity: 0;
        position: absolute;
        z-index: 1;
        left: 0;
        top: 0;
        font-size: 100px;
    }

    .zone:hover {
        cursor: pointer;
    }
</style>