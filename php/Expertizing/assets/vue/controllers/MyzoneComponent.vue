<template>
  <div>
    <div id="my-dropzone" class="dropzone"></div>
  </div>
</template>

<style>

  .dropzone {
    max-width: 730px !important;
    height: 300px !important;
  }

</style>

<script>
import axios from 'axios';
import Dropzone from 'dropzone';

const url1 = '/api/get_signed_url?file-name=' + '1679660451.jpg' + '&file-type=' + 'jpg';

// axios.get(url1).then(function(response) {
//       const signedUrl = response.data.signedUrl;
//       axios.get(signedUrl).then(function(response1){
//         console.log(response1);
//       });
// });

export default {
  // name: "UploadForm",
  mounted() {
    this.initDropzone();
  },

  methods: {
    initDropzone() {
      const self = this;

      Dropzone.autoDiscover = false;

      const myDropzone = new Dropzone('#my-dropzone', {
        url: 'http://localhost:8080',
        maxFilesize: 2, // in MB
        acceptedFiles: 'image/jpeg',
        paramName: 'file',
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        dictDefaultMessage: 'Drop files here or click to upload',
        headers: {
          'Content-Type': 'image/jpeg',
        },
        init() {
          this.on('sending', function(file, xhr, formData) {
            let newFileName = Math.floor(Date.now() / 1000) + '.' + file.name.split('.').pop();
            const url = '/api/put_signed_url?file-name=' + file.name + '&file-type=' + file.type + '&file-size=' + file.size;
            axios.get(url).then(function(response) {
              const signedUrl = response.data.signedUrl;
              // formData.append('file', file);
              xhr.open('PUT', signedUrl);
              xhr.send(file);
            });
          });

          this.on('complete', function(file) {
           if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
          self.$emit('upload-complete');
        }
        });

          this.on('success', function(file, response) {
              console.log(response);
          });
    },
  });
},
},
};
</script>
