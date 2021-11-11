<template>
	<div>

	<div class = "row">
		<router-link to = "/category" class = "btn btn-primary"> All Category  </router-link>
	</div>

	 <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Category Update</h1>
                  </div>
                  <form @submit.prevent = "categoryUpdate">
                   <div class="form-group"> 
                      <div class = "form-row">
                      	<div class = "col-sm-12">
                      		<input type="text" class="form-control" id="exampleInputFirstName" v-model = "form.category_name" placeholder="Enter Your Category Name">
                              <small class="text-danger" v-if = "errors.category_name"> {{ errors.category_name[0] }}  </small>
                      	</div>
                      </div>
                    </div>

                    <div class="form-group"> 
                      <div class = "form-row">
                      	<div class = "col-sm-12">
                      		<input type="text" class="form-control" id="exampleInputFirstName" v-model = "form.category_link" placeholder="Enter Your Category Link">
                              <small class="text-danger" v-if = "errors.category_link"> {{ errors.category_link[0] }}  </small>
                      	</div>
                      </div>
                    </div>

                  
                    <div class="form-group">
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

    data(){
    return{
      form:{
       category_name: null,
        category_link: null,
        category_id: null,
      },
      errors:{},
      categories:{},
    }
  },
   created(){
    let id = this.$route.params.id
    axios.get('/api/category/'+id)
    .then(({data}) => (this.form = data))
    .catch(console.log('error'))

    // Category Collected 
    axios.get('/api/category/')
    .then(({data}) => (this.categories = data))
  },
  methods:{

    categoryUpdate(){
      let id = this.$route.params.id
      axios.patch('/api/category/'+id,this.form)
      .then(() => {
        this.$router.push({name : 'category'})
        Notification.success()
      })
      .catch(error =>this.errors = error.response.data.errors)
      
    }
  }

  }
  

</script>



<style type="text/css">
	

</style>
