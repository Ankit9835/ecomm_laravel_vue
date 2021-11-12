<template>
  
  <div>

 <div class="row">
  <router-link to="/product" class="btn btn-primary">View Product </router-link>
   
 </div>

     <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-4 col-md-4">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Product Images</h1>
                  </div>

      
        
        <div class="row">
        
            <div class="col-md-4">
              
              
                         <p v-for="image in images"> <img v-bind:src="'http://127.0.0.1:8000/' + image.image" id = "em_photo" />  </p>
                         <br>
                  
                
            </div>
          
       

        
          
           
          
        </div>

           

       
        
      
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
   

   
      <div class="col-xl-8 col-lg-8 col-md-8">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">View Product</h1>
                  </div>

      
        
        <div class="row">
        
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Product Name</strong></label>
      
                 <p> {{ product.product_name }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Product Code</strong></label>
      
                 <p> {{ product.product_code }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Category Name</strong></label>
      
                 <p> {{ product.category.category_name }} </p>
            </div>
          
        </div>

        <div class="row">
        
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Sub Category</strong></label>
      
                 <p> {{ product.sub_category.sub_category_name }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Sub Sub Category</strong></label>
      
                 <p> {{ product.sub_sub_category.sub_sub_category_name }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Brand Name</strong></label>
      
                 <p> {{ product.brand.name }} </p>
            </div>
          
        </div>

         <div class="row">
        
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Quantity</strong></label>
      
                 <p> {{ product.quantity }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Product Size</strong></label>
      
                 <p> {{ product.product_size }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Product Color</strong></label>
      
                 <p> {{ product.product_color}} </p>
            </div>
          
        </div>

        <div class="row">
        
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Selling Price</strong></label>
      
                 <p> {{ product.selling_price }} </p>
            </div>
          
       

        
          
            <div class="col-md-4">
                <label for="exampleFormControlSelect1"><strong class = "">Discount Price</strong></label>
      
                 <p> {{ product.discount_price }} </p>
            </div>
          
       

        
          
           
        </div>



           

      
        
      
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
   
      errors:{},
      
      product:[],
      images:[],
    }
  },
  created(){
   // this.getCategory();
     window.id = this.$route.params.id
    axios.get('/api/product/'+id)
    .then(({data}) => (this.product = data))
    .catch(console.log('error'))
    this.productImage();
    

  },
  methods:{
     
    productImage(){
        let product_id = id;
         axios.get('/api/product/image/'+id)
        .then(({data}) => (this.images = data))
        .catch()
        },
  
   
  },
  }
</script>


<style type="text/css">
  .bootstrap-tagsinput .tag{
      margin-right: 2px;
      color: #33300a;
  }
  	
  #em_photo {
    height: 150px;
    width: 150px;
}
</style>