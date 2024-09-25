<template>
  <div>
    <div class="item">
      <input 
        type="checkbox"
        :checked="item.completed"
        @change="updateCheck"
        v-model="item.completed" />
      <span :class="['itemText', { completed: item.completed }]">
        {{ item.name }}
      </span>
      <button @click="openEditModal" class="pen">
        <font-awesome-icon icon="pen-to-square" />
      </button>
      <button @click="openDeleteModal" class="trashcan">
        <font-awesome-icon icon="trash" />
      </button>
    </div>

    <!-- Edit Modal -->
    <div v-if="showModal" class="edit-modal-overlay">
      <div class="edit-modal-content">
        <h3 class="edit-item-title">{{$t('EditItem')}}</h3>
        <input v-model="editName" type="text"/>
        <div class="edit-buttons">
        <button class="save-button" @click="saveEdit">{{$t('SaveEdit')}}</button>
        <button class="cancel-button" @click="closeEditModal">{{$t('CancelEdit')}}</button>
      </div>
      </div>
    </div>

     <!-- Delete Modal -->
    <div v-if="deleteModal" class="delete-modal-overlay">
      <div class="delete-modal-content">
        <h3 class="delete-item-title">{{$t('DeleteItem')}}</h3>
        <div class="delete-buttons">
        <button class="delete-button" @click="removeItem">{{$t('Delete')}}</button>
        <button class="cancel-detele-button" @click="closeDeleteModal">{{$t('CancelDelete')}}</button>
      </div>
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
        deleteModal: false,
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
      openDeleteModal() {
        this.deleteModal = true;
      },
      closeDeleteModal() {
        this.deleteModal = false;
      },
      removeItem() {
        this.deleteItem(this.item.id).then(() => {
          this.$emit('itemChanged');
          this.closeDeleteModal();
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
  