<template>
  <div>
    <div class="addItem">
      <button @click="openAddItemModal" class="plus">
        <font-awesome-icon icon="circle-plus" />
      </button>
    </div>
    <!-- Add Item Modal -->
    <div v-if="addModal" class="add-modal-overlay">
      <div class="add-modal-content">
        <h3 class="add-item-title">{{ $t('addItemTitle') }}</h3>
        <input class="inputfield" type="text" :placeholder="$t('placeholder')" v-model="item.name">
        <div class="add-buttons">
          <button class="add-button" @click="addItem">{{ $t('AddItem') }}</button>
          <button class="cancel-add-button" @click="closeAddItemModal">{{ $t('CancelAddItem') }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      addModal: false,
      item: {
        name: ""
      }
    };
  },
  methods: {
    ...mapActions(['createItem']),
    openAddItemModal() {
      this.addModal = true;
    },
    closeAddItemModal() {
      this.addModal = false;
    },
    async addItem() {
      if (this.item.name.trim() === "") return;
      try {
        await this.createItem(this.item);
        this.item.name = "";
        this.$emit('reloadList');
        this.closeAddItemModal();
      } catch (error) {
        console.error('Error adding item:', error);
      }
    }
  }
};
</script>
