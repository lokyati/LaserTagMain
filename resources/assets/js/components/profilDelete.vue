<template>
    <section>
        <button class="button is-medium is-danger" @click="confirmCustomDelete">
            Launch confirm (custom)
        </button>
    </section>
</template>

<script>
    export default {
        methods: {
            confirmCustomDelete() {
                this.$dialog.confirm({
                    title: 'Deleting account',
                    message: 'Are you sure you want to <b>delete</b> your account? This action cannot be undone.',
                    confirmText: 'Delete Account',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.$toast.open('Account deleted!')
                })
            }
        }
    }
</script>
