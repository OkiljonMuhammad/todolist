<template>
  <div class="addItem">
    <input class="inputfield" type="text" :placeholder="$t('placeholder')" v-model="item.name">
    <font-awesome-icon
      icon="file-circle-plus"
      @click="addItem"
      :class="[item.name ? 'active' : 'inactive', 'plus']"
    />
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      item: {
        name: ""
      }
    };
  },
  methods: {
    ...mapActions(['createItem']),
    async addItem() {
        if (this.item.name === "") return;
        try {
            await this.createItem(this.item);
            this.item.name = "";
            this.$emit('reloadList');
        } catch (error) {
            console.error('Error adding item:', error);
        }
    }
}
};
</script>

