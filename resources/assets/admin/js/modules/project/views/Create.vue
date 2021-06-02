<template>
  <div>
    <form @submit.prevent="createProject">
        <div class="card card-default">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">{{ $t('project.title_english') }}</label>
                      <input class="form-control" type="text" 
                      :placeholder="$t('project.enter_title_english')" 
                      v-model="dataProject.titleEN"  
                      :class="{ 'is-invalid': submitted && $v.dataProject.titleEN.$error }"/>
                     <div v-if="!$v.dataProject.titleEN.required" class="invalid-feedback">{{ $t('project.title_en_required') }}</div>
                     <div v-if="!$v.dataProject.titleEN.maxLength" class="invalid-feedback">{{ $t('project.title_en_max') }} {{$v.dataProject.titleEN.$params.maxLength.max}} {{ $t('project.letter') }}</div>
                    </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                      <label for="">{{ $t('project.title_japan') }}</label>
                      <input class="form-control" type="text" 
                      :placeholder="$t('project.enter_title_japanese')" 
                      v-model="dataProject.titleJP"  
                      :class="{ 'is-invalid': submitted && $v.dataProject.titleJP.$error }"/>
                     <div v-if="!$v.dataProject.titleJP.required" class="invalid-feedback">{{ $t('project.title_jp_required') }}</div>
                     <div v-if="!$v.dataProject.titleJP.maxLength" class="invalid-feedback">{{ $t('project.title_jp_max') }} {{$v.dataProject.titleJP.$params.maxLength.max}} {{ $t('project.letter') }}</div>
                    </div>
              </div>
            </div>
          </div>
        <!-- </div> -->

        <!-- <div class="card card-default"> -->
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6 mb-3">
              
                  <label>{{ $t('project.content_english') }}</label>
                  <vue-editor v-model="dataProject.contentEN"></vue-editor>
                
                  <div v-if="$v.dataProject.contentEN.$error" class="error">{{ $t('project.content_en_required') }}</div>
              </div>

              <div class="form-group col-md-6 mb-3">
                <label>{{ $t('project.content_japan') }}</label>
                <vue-editor v-model="dataProject.contentJP"></vue-editor>
                <div v-if="$v.dataProject.contentJP.$error" class="error">{{ $t('project.content_jp_required') }}</div>
              </div>
            </div>
          </div>

           <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6 mb-3">
                <label>{{ $t('project.image') }}</label>
                <div id="my-strictly-unique-vue-upload-multiple-image" style="display: flex; justify-content: center;">
                  <vue-upload-multiple-image
                    @upload-success="uploadImageSuccess"
                    @before-remove="beforeRemove"
                    @edit-image="editImage"
                    @limit-exceeded ="limitexceeded(this.amount)"
                    :primaryText= "$t('project.default')"
                    :dragText = "$t('project.drag_images')"
                    :browseText = "$t('project.or_choose')"
                    :markIsPrimaryText = "$t('project.set_as_default')"
                    :popupText = "$t('project.image_displayed_as_default')"
                    :dropText = "$t('project.drop_your_file_here')"
                    accept = "image/jpeg,image/png,image/bmp,image/jpg"
                  ></vue-upload-multiple-image>
                </div>
                <div v-if="submitted && !$v.dataProject.images.required" class="error">{{ $t('project.image_required') }} </div>
                <div v-if="submitted && !$v.dataProject.images.maxLength" class="error">{{ $t('project.image_max') }} {{$v.images.$params.maxLength.max}}</div>
            </div>
            </div>
          </div>
            <div class="modal-footer">
              <router-link class="btn btn-secondary" :to="{path: '/projects'}">{{ $t('common.close') }}</router-link>
              <button type="submit" class="btn btn-primary">{{ $t('common.save') }}</button>
            </div>
        </div>
        

    </form>
  </div>
</template>

<script>
import { VueEditor } from 'vue2-editor';
// import UploadImage from './UploadImage.vue';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import {required,maxLength} from 'vuelidate/lib/validators';
export default {
    name: 'create',
    data() {
        return {
            dataProject: {
                titleEN: null,
                titleJP: null,
                contentEN: null,
                contentJP: null,
                images: [],
            },
            submitted: false,
            amount: 5
        };
    },
    validations: {
        dataProject: {
            titleEN: {
                required,
                maxLength: maxLength(255)
            },
            titleJP: {
                required,
                maxLength: maxLength(255)
            },
            contentEN: {required},
            contentJP: {required},
            images: {
                required,
                maxLength: maxLength(5)
            }
        }
        
    },
    components: {
        VueEditor,
        VueUploadMultipleImage
    },
    methods: {
        async createProject(){
            this.submitted = true;
            this.$v.$touch();
            if (this.$v.$invalid) {
                return;
            }
        },
        uploadImageSuccess(formData, index, fileList) {
            this.dataProject.images = fileList;
        },
        beforeRemove (index, done, fileList) {
            var r = confirm('remove image');
            if (r === true) {
                this.dataProject.images = fileList;
                done();
            }
        },
      
        editImage (formData, index, fileList) {
            this.dataProject.images = fileList;
        }
    }
};
</script>

<style>
.error {
  color: red;
}
.invalid-feedback {
  font-size: 100%;
}
</style>