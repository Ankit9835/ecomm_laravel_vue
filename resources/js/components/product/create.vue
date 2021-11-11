<template>
  
  <div>

 <div class="row">
  <router-link to="/product" class="btn btn-primary">All Product </router-link>
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Product</h1>
                  </div>

      <form class="user" @submit.prevent="productInsert" enctype="multipart/form-data">

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Product Name<code>*</code></label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Name" v-model="form.product_name">
          <small class="text-danger" v-if="errors.product_name"> {{ errors.product_name[0] }} </small>
            </div>

             <div class="col-md-6">
      <label for="exampleFormControlSelect1">Product Code<code>*</code></label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Code" v-model="form.product_code">
           
            </div>   


        
            
          </div>
        </div>

            <div class="form-group">

          <div class="form-row">
            <div class="col-md-4">
      <label for="exampleFormControlSelect1">Product Category<code>*</code></label>
 <select
                                                    class="form-control"
                                                    id="exampleFormControlSelect1"
                                                    v-model="form.category_id"
                                                    @change="onChange($event)">
                                              
        <option v-for="data in categories" :value="data.id">
          {{
            data.category_name
          }}
          </option>       
            
                      </select>   
                  
                      
        
            </div>


     <div class="col-md-4">
          <label for="exampleFormControlSelect1">Product Sub Category</label>
  <select
                                                    v-model="
                                                        form.sub_category_id
                                                    "
                                                    class="form-control"  @change="onChangeSubCategory($event)"
                                                >
                                                    <option
                                                        v-for="data in subcategories"
                                                        :value="data.id"
                                                        >{{
                                                            data.sub_category_name
                                                        }}</option
                                                    >
                                                    
                                                </select>   
                                                
            </div>


    <div class="col-md-4">
          <label for="exampleFormControlSelect1">Product Sub Sub Category</label>
 <select class="form-control" id="exampleFormControlSelect1" v-model="form.sub_sub_category_id">
                        <option
                                                        v-for="data in sub"
                                                        :value="data.id"
                                                        >{{
                                                            data.sub_sub_category_name
                                                        }}</option
                                                    >
                                                    
    
                        
                      </select>    
            </div>               
            
          </div>
        </div>

       


 <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Brand<code>*</code></label>
        <select class="form-control" id="exampleFormControlSelect1" v-model="form.brand_id">
   
    <option :value="brand.id" v-for="brand in brands">{{ brand.name }}</option>
                        
                      </select>   
     
            </div>


 <div class="col-md-6">
              <label for="exampleFormControlSelect1">Quantity<code>*</code></label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Quantity"  v-model="form.quantity">
     
            </div>



       
            
          </div>
        </div>




 



        <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Product Size</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Size" v-model="form.product_size">
  
            </div>


     <div class="col-md-6">
      <label for="exampleFormControlSelect1">Product Color</label>
      <br>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Color" data-role="tagsinput" v-model="form.product_color">
         
            </div>     
            
          </div>
        </div>


         <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
  <label for="exampleFormControlSelect1">Selling Price<code>*</code></label>
         <input type="number" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Selling Price" v-model="form.selling_price">
        <small class="text-danger" v-if = "errors.selling_price"> {{ errors.selling_price[0] }}  </small>     
            </div>


     <div class="col-md-6">
       <label for="exampleFormControlSelect1">Discount Price<code>*</code></label>
         <input type="number" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Discount Price" v-model="form.discount_price">
       
            </div>     
            
          </div>
        </div>


         <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
  <label for="exampleFormControlSelect1">Video Link</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Video Link" v-model="form.video_link">
        
            </div>


        
            
          </div>
        </div>

          <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
             <input type="file" class="form-control" ref="file"  multiple  @change="uploadImage"/>
              <!-- <div  v-for="(image, key) in form.images" :key="key">
                  <img :src="image.src" class="preview" style="width:200px;"/>
                    {{ image.file.name }}
              </div> -->
            </div>
          </div>
        
          </div>

          <!-- <div class="form-group"> -->

          <!-- <div class="form-row">
            <div class="col-md-12"> -->
                <!-- <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected" multiple/>

                                                <label
                                                    class="custom-file-label"
                                                    for="customFile"
                                                 >Choose file</label>
                                                 </div> -->

             <!-- <div class="col-md-4">
  <label for="exampleFormControlSelect1">Image Two :</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Quantity" v-model="form.product_quantity">
         <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
            </div>

         <div class="col-md-4">
  <label for="exampleFormControlSelect1">Image Three:</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Quantity" v-model="form.product_quantity">
         <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
            </div> -->

        
<!--             
          </div>
        </div> -->


         <div class="form-group">

          <div class="form-row">
            <div class="col-md-4">
  <label for="exampleFormControlSelect1">Main Slider:</label>
        <input type="checkbox" name = "main_slider" v-model="form.main_slider" :value="1">
     
            </div>

             <div class="col-md-4">
  <label for="exampleFormControlSelect1"> Hot Deal :</label>
         <input type="checkbox" name = "hot_deal"  v-model="form.hot_deal">
        
            </div>

         <div class="col-md-4">
  <label for="exampleFormControlSelect1">Best Rated:</label>
       <input type="checkbox" name = "best_rated"  v-model="form.best_rated">
        
            </div>

        
            
          </div>
        </div>


           <div class="form-group">

          <div class="form-row">
            <div class="col-md-4">
  <label for="exampleFormControlSelect1">Trend:</label>
        <input type="checkbox" name = "trend"  v-model="form.trend">
       
            </div>

             <div class="col-md-4">
  <label for="exampleFormControlSelect1"> Hot New :</label>
         <input type="checkbox" name = "hot_new"  v-model="form.hot_new">
        
            </div>

         <div class="col-md-4">
  <label for="exampleFormControlSelect1">Buy One Get One:</label>
       <input type="checkbox" name = "best_one_get_one"  v-model="form.buy_one_get_one">
       
            </div>

        
            
          </div>
        </div>


       
      


        <div class="form-group mt-4">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        
      </form>
                  <hr>
                  <div class="text-center">
  
  
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>



<script type="text/javascript">
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
    data(){
    return {
      form:{
        product_name:null,
        product_code:null,
        category_id:null,
        sub_category_id:null,
        brand_id:null,
        sub_sub_category_id:null,
        quantity:null,
        product_size:null,
        product_color:null,
         image: [],
        selling_price:null,
        discount_price:null,
        video_link:null,
        main_slider:null,
        hot_deal:null,
        best_rated:null,
        trend:null,
        hot_new:null,
        buy_one_get_one:null,
      },
      errors:{},
      
      products:{},
      categories: [],
      subcategories: [],
      sub: [],
      brands: [],
    }
  },
  created(){
    this.getCategory();
    this.getBrand();
  },
  methods:{
      productInsert(){
      axios.post('/api/product',this.form)
      .then(() => {
        console.log(this.form.image);
        this.$router.push({name : 'product'})
        Notification.success()
      })
      .catch(error =>this.errors = error.response.data.errors)
      },

       uploadImage(e) {
          //  let vm = this;
            // var selectedFiles = e.target.files;
            
            // for (let i = 0; i < selectedFiles.length; i++) {
            //     let img = {
            //         src: URL.createObjectURL(selectedFiles[i]),
            //         file: selectedFiles[i],
            //     }
            //     //this.images.push(img);
            //      this.form.image.push(img);
            //      console.log(this.form.image.push(img));
            // }
            
            // let selectedFiles = e.target.files;
            // if(!selectedFiles.length){
            //   return false;
            // } 

            // for(let i=0;i<selectedFiles.length;i++){
            //   this.form.image.push(selectedFiles[i])
            // }

            // console.log(this.form.image);
            

              for (let file of e.target.files) {
                    try {
                        let reader = new FileReader();

                       reader.onload = event => {
                         console.log(event.target.result);
                         const img = event.target.result
                         this.form.image.push(img);
                    //this.form.images.push(file);
                       // console.log(this.form.image.push(img));
                       };
                    reader.readAsDataURL(file);
                        


                        
                    } catch {}
                }
          
                // const tmpFiles = e.target.images
                //   if (tmpFiles.length === 0) {
                //     return false;
                //   }
                // const file = tmpFiles[0]
                // this.form.image.push(file)
                // const self = this
                //   const reader = new FileReader()
                // reader.onload = function(e) {
                //   self.rawData.push(e.target.result)
                // }
                // reader.readAsDataURL(file)
    
        },
    
      
    
     
         
       getCategory: function() {
            axios.get("/api/category").then(
                function(response) {
                    this.categories = response.data;
                }.bind(this)
            );
        },
        
        onChange(event) {
            console.log(event.target.value);
            window.id = event.target.value;
            axios
                .get("/api/category/subcategory/ajax/" + id)
                .then(({ data }) => (this.subcategories = data))
                .catch(console.log("error"));
        },
        onChangeSubCategory(event){
          console.log(event.target.value);
          console.log(id);
          let sub_category_id = event.target.value;
          let category_id = id;
         axios.get("/api/subcategory/sub-sub-category/" + sub_category_id + '/' + category_id).then(
                function(response) {
                    this.sub = response.data;
                }.bind(this)
            );
               
        },
        getBrand: function() {
            axios.get("/api/brand").then(
                function(response) {
                    this.brands = response.data;
                }.bind(this)
            );
        }
      
  },
  
   
  }
   
</script>


<style type="text/css">
  .bootstrap-tagsinput .tag{
      margin-right: 2px;
      color: #33300a;
  }
</style>