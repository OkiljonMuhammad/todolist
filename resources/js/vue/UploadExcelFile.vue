<template>
  <div>
    <div class="uploadFile">
      <button @click="openUploadModal" class="file-plus">
       {{$t('upload-file')}} <font-awesome-icon icon="file-circle-plus" />
      </button>
    </div>
    <div v-if="uploadModal" class="upload-modal-overlay">
      <div class="upload-modal-content">
      <h3 class="upload-file-title">{{$t('upload-excel-file')}}</h3>
      <div class="upload-container">
      <label class="upload-label" for="upload">{{ this.isUploadName ? $t('choose-file') : this.answer }}</label>
      <input id="upload" type="file" hidden @change="onFileChange" accept=".xlsx, .xls, .csv" />
    </div>
      <div class="upload-buttons">
      <button class="upload-button" @click="uploadFile">{{$t('upload')}}</button>
      <button class="cancel-upload-button" @click="closeUploadModal">{{$t('cancel-upload')}}</button>
      </div>
      </div>
    </div>
  </div>
  </template>
  
  <script>
export default {
  data() {
    return {
      uploadModal: false,
      selectedFile: null,
      isUploadName: true,
      answer: ""
    };
  },
  methods: {
    openUploadModal() {
      this.uploadModal = true;
    },
    closeUploadModal() {
      this.uploadModal = false;
    },
    onFileChange(event) {
      this.selectedFile = event.target.files[0];
    },
    async uploadFile() {
      if (!this.selectedFile) {
        alert('Please select a file first.');
        return;
      }

      const formData = new FormData();
      formData.append('file', this.selectedFile);

      try {
        await this.$store.dispatch('uploadExcelFile', formData);
        this.isUploadName = false;
        this.answer = "File uploaded successfully";
        await this.$store.dispatch('fetchItems');
        setTimeout(() => {
          this.isUploadName = true;
          this.closeUploadModal();
        }, 2000);

      } catch (error) {
        this.answer = "File upload failed";
        this.isUploadName = false;
        console.error('Error uploading file:', error);
      }
    }
  }
};
</script>
