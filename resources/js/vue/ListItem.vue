<template>
  <div>
    <div class="item">
      <input 
        type="checkbox"
        @change="updateCheck"
        v-model="item.completed" />
      <span :class="['itemText', { completed: item.completed }]">
        {{ item.name }}
      </span>
      <button @click="openEditModal" class="pen">
        <font-awesome-icon icon="pen-to-square" />
      </button>
      <button @click="removeItem" class="trashcan">
        <font-awesome-icon icon="trash" />
      </button>
    </div>

    <!-- Edit Modal -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <h3>{{$t('EditItem')}}</h3>
        <input v-model="editName" type="text" placeholder="Enter new name" />
        <button @click="saveEdit">{{$t('SaveEdit')}}</button>
        <button @click="closeEditModal">{{$t('CancelEdit')}}</button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  props: ['item'],
  data() {
    return {
      showModal: false,
      editName: this.item.name
    };
  },
  methods: {
    ...mapActions(['deleteItem', 'updateItem']),
    updateCheck() {
      this.$store.dispatch('updateItem', this.item).then(() => {
        this.$emit('itemChanged');
      }).catch(error => {
        console.error(error);
      });
    },
    removeItem() {
      this.deleteItem(this.item.id).then(() => {
        this.$emit('itemChanged');
      }).catch(error => {
        console.error(error);
      });
    },
    openEditModal() {
      this.showModal = true;
      this.editName = this.item.name; 
    },
    closeEditModal() {
      this.showModal = false;
    },
    saveEdit() {
      if (this.editName.trim() !== '') {
        this.item.name = this.editName.trim();
        this.updateItem(this.item).then(() => {
          this.$emit('itemChanged');
          this.closeEditModal(); 
        }).catch(error => {
          console.error(error);
        });
      }
    }
  }
};
</script>
