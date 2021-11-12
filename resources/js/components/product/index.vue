<template>
	<div>

    <div class="row">
            
            
  <br>
            <div class="col-lg-12 my-5">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Category</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                         <th>Sr. No</th>
                          <th>Product Code</th>
                          <th>Image</th>
                        <th>Product Name</th>
                       
                        <th>Category Name</th>
                        <th>Brand Name</th>
                       
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for = "(product, index) in filterSearch" :key="product.id">
                        <td> {{ index + 1 }}  </td>
                         <td><strong>{{ product.product_code }}</strong></td>  
                         <td> <img :src="product.product_image.image" id="em_photo">  </td>
                        <td><strong>{{ product.product_name }}</strong></td>
                                     
                        <td><strong>{{ product.category.category_name }}</strong></td>
                         <td><strong>{{ product.brand.name }}</strong></td>
                         
                        <td width = "200">
                          <router-link :to="{name: 'view-product', params:{id:product.id}}" class="btn btn-sm btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></router-link>
                          <router-link :to="{name: 'edit-product', params:{id:product.id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></router-link>
                          <a @click = "deleteProduct(product.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt text-white"></i></a> 
                         
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
    </div>

	</div>

</template>

<script>
  
  export default {

    created(){
      if(!User.loggedIn()){
         this.$router.push({name : '/'})
      }
    },

    created(){
    this.allProduct();
  }, 

    data(){
      return {
        form:{
        category_name: null,
        category_link: null
      },
        products:[],
        errors:{},
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
        return this.products.filter(product => {
          return product.product_name.match(this.searchTerm)
        })
      }
    },

    methods:{

     categoryInsert(){
      axios.post('/api/category',this.form)
      .then(() => {
        Reload.$emit('AfterAdd');
        //this.$router.push({name : 'category'})
        Notification.success()
      })
      .catch(error =>this.errors = error.response.data.errors)
      
    },
      allProduct(){
        axios.get('/api/product')
        .then(({data}) => (this.products = data))
        .catch()
      },

      deleteProduct(id){
       Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
             axios.delete('/api/product/'+id)
               .then(() => {
                this.products = this.products.filter(product => {
                  return product.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'product'})
               })
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
     }
    },

     

     
  

}
  

</script>



<style type="text/css">
	
  #em_photo {
    height: 60px;
    width: 60px;
}

</style>
