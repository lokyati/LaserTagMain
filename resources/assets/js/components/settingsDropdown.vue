<template>
  <div
    class="dropdown is-right"
    v-bind:class="{ 'is-active': isDropdownActive }"
    v-on-clickaway="away">
    <div
      class="dropdown-trigger"
      @click="isDropdownActive=!isDropdownActive">
      <a
        aria-haspopup="true"
        aria-controls="{ 'dropdown-menu'}">
        <span class="settings_icon icon is-medium">
           <i class="fas fa-sliders-h fa-2x"></i>
        </span>
      </a>
    </div>
    <div
      class="dropdown-menu"
      id="dropdown-menu"
      role="menu">
      <div id="app" class="dropdown-content">
        <profildelete></profildelete>
      </div>
    </div>
  </div>
</template>

<script>
import { mixin as clickaway } from 'vue-clickaway';
import profilDelete from './profilDelete'

export default {
  props: ['id'],
  mixins: [ clickaway ],
  data() {
    return {
      isDropdownActive: false,
    }
  },
  components: {
    profildelete: profilDelete
  },
  methods: {
    away() {
      this.isDropdownActive = false;
    },
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
};
</script>

<style scoped>
  .dropdown{
    float:right;
  }
  .settings_icon{
    padding: 1.5rem;
    color:white;
    float: right;
  }
</style>