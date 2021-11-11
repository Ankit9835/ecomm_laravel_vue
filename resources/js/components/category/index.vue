<template>
	<div>

    <div class="row">
            
            <div class="col-lg-5 mb-4">

               <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                  </div>
                  <form @submit.prevent = "categoryInsert">
                   

                   <div class = "form-row">
                      	<div class = "col-sm-12">
                          <label> <strong> Category Name </strong> </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" v-model = "form.category_name" placeholder="Enter Your Category Name">
                          <small class="text-danger" v-if = "errors.category_name"> {{ errors.category_name[0] }}  </small>   
                      	</div>
                    </div>

                    <div class = "form-row mt-3">
                      	<div class = "col-sm-12">
                          <label> <strong> Category Link </strong> </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" v-model = "form.category_link" placeholder="Enter Your Category Link">
                          <small class="text-danger" v-if = "errors.category_link"> {{ errors.category_link[0] }}  </small>   
                      	</div>
                    </div>
                  
                    <div class="form-group mt-2">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <hr>
                   
                  </form>
                  <hr>
                 
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

            </div>
  <br>
            <div class="col-lg-7 my-5">
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
                        <th>Category Name</th>
                        <th>Category Link</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for = "(category, index) in filterSearch" :key="category.id">
                        <td> {{ index + 1 }}  </td>
                        <td><strong>{{ category.category_name }}</strong></td>
                         <td  v-if="category.category_link">
                           {{ category.category_link }}
                        </td>
                        <td  v-else>
                           No Category Link
                          </td>                        
                       
                        
                         
                        <td><router-link :to="{name: 'edit-category', params:{id:category.id}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                       &nbsp;
                        <a @click = "deleteCategory(category.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt text-white"></i></a> 
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
    this.allCategory();
    Reload.$on('AfterAdd',() => {
      this.allCategory();
    })
  }, 

    data(){
      return {
        form:{
        category_name: null,
        category_link: null
      },
        categories:[],
        errors:{},
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
        return this.categories.filter(category => {
          return category.category_name.match(this.searchTerm)
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
      allCategory(){
        axios.get('/api/category')
        .then(({data}) => (this.categories = data))
        .catch()
      },

      deleteCategory(id){
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
             axios.delete('/api/category/'+id)
               .then(() => {
                this.categories = this.categories.filter(category => {
                  return category.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'category'})
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
	
  

</style>
