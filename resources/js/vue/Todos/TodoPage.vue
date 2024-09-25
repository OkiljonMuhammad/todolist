<template>
  <router-link to="/home">Home</router-link>
  <div class="todoListContainer">
    <div class="heading">
      <h1 id="title">{{ $t('todoList') }}</h1>
      <add-item-form v-on:reloadList="fetchItems" />
      <upload-excel-file />
      <export-excel-file />

      <div class="status-container">
        <button 
          @click="setActive('getAll')" 
          :class="{ active: currentComponent === 'ListView' }">
          all todos
        </button>
        <button 
          @click="setActive('pending')" 
          :class="{ active: currentComponent === 'PendingItemView' }">
          pending
        </button>
        <button 
          @click="setActive('inProgress')" 
          :class="{ active: currentComponent === 'InProgressItemView' }">
          in progress
        </button>
        <button 
          @click="setActive('canceled')" 
          :class="{ active: currentComponent === 'CanceledItemView' }">
          canceled
        </button>
        <button 
          @click="setActive('completed')" 
          :class="{ active: currentComponent === 'CompletedItemView' }">
          completed
        </button>
        <button 
          @click="setActive('archived')" 
          :class="{ active: currentComponent === 'ArchivedItemView' }">
          archived
        </button>
      </div>
    </div>
    <component :is="currentComponent"></component>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import ListView from './AllTodos/ListView.vue';
import AddItemForm from './AddItemForm.vue'; 
import UploadExcelFile from './UploadExcelFile.vue';
import ExportExcelFile from './ExportExcelFile.vue';
import PendingItemView from './Status/Pending/PendingItemView.vue';
import InProgressItemView from './Status/InProgress/InProgressItemView.vue';
import CanceledItemView from './Status/Canceled/CanceledItemView.vue';
import CompletedItemView from './Status/Completed/CompletedItemView.vue';
import ArchivedItemView from './Status/Archived/ArchivedItemView.vue';

export default {
  data() {
    return {
      currentComponent: 'ListView', 
    };
  },
  components: {
    ListView,
    AddItemForm,
    UploadExcelFile,
    ExportExcelFile,
    PendingItemView,
    InProgressItemView,
    CanceledItemView,
    CompletedItemView,
    ArchivedItemView,
  },
  methods: {
    ...mapActions(['fetchItems']),
    
    setActive(status) {
      switch (status) {
        case 'getAll':
          this.currentComponent = 'ListView';
          break;
        case 'pending':
          this.currentComponent = 'PendingItemView';
          break;
        case 'inProgress':
          this.currentComponent = 'InProgressItemView';
          break;
        case 'canceled':
          this.currentComponent = 'CanceledItemView';
          break;
        case 'completed':
          this.currentComponent = 'CompletedItemView';
          break;
        case 'archived':
          this.currentComponent = 'ArchivedItemView';
          break;
        default:
          this.currentComponent = 'ListView';
      }
    }
  },
  created() {
    this.fetchItems();
  }
};
</script>
