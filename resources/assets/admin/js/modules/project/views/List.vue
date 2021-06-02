<template>
  <div>
    <router-link :to="{name:'Create'}" class="btn btn-primary">
          <i class="fas fa-plus"></i>
           {{ $t('project.create') }}
    </router-link>
      <p>list project</p>
  </div>
</template>

<script>
export default {
    created() {
        this.$store.commit('SET_ACTIVE_ASIDE', {
            aside: 'projects'
        });
    }
};
</script>

<style>
    .modal-dialog {
        max-width: 800px;
    }
</style>