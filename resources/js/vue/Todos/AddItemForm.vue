<template>
  <div>
    <div class="addItem">
      <button @click="openAddItemModal" class="circle-plus">
        {{$t('add-note')}} <font-awesome-icon icon="circle-plus" />
      </button>
    </div>
    <!-- Add Item Modal -->
    <div v-if="addModal" class="add-modal-overlay">
      <div class="add-modal-content">
        <h3 class="add-item-title">{{ $t('addItemTitle') }}</h3>
        <form>
          <label for="category">Select category</label>
          <select name="category" id="category" v-model="item.parent_id">
          <option v-for="(category, index) in categories" :key="index" :value="category.id">{{category.name}}</option>
        </select>
        </form>
        <input class="inputfield" type="text" :placeholder="$t('placeholder')" v-model="item.name">
        <div class="add-buttons">
          <button class="add-button" @click.prevent="addItem">{{ $t('AddItem') }}</button>
          <button class="cancel-add-button" @click.prevent="closeAddItemModal">{{ $t('CancelAddItem') }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions } from 'vuex';

export default {
  data() {
    return {
      addModal: false,
      item: {
        name: "",
        parent_id: "",
      },
    };
  },
  computed: {
    ...mapState(['categories'])
  },
  created() {
    this.fetchCategories();
  },
  methods: {
    ...mapActions(['createItem', 'fetchCategories', 'fetchByCategory']),
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
        this.fetchByCategory();
      } catch (error) {
        console.error('Error adding item:', error);
      }
    }
  }
};
</script>
