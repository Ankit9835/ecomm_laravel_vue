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
                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                  </div>
                  <form @submit.prevent = "categoryInsert">
                   

                   <div class = "form-row">
                      	<div class = "col-sm-12">
                        <label> <strong> Select Category </strong> </label>
                      		<select class="form-control" id="exampleFormControlSelect1" v-on:change="fetchData" v-model="form.category_id">  
                             
                              <option value="0">Root</option>
                              <option v-for="category in categories" :value="category.id">{{ category.category_name }}</option>\
                                
                                <small class="text-danger" v-if = "errors.category_id"> {{ errors.category_id[0] }}  </small>  
                            </select>
                            
                      	</div>
                    </div>
                    <input type = "hidden"  v-model="form.sub_category">
                    <br>
                     <div class="form-group"> 
                      <div class = "form-row">
                      	<div class = "col-sm-12">
                      		<input type="text" class="form-control" id="exampleInputFirstName" v-model = "form.category_name" placeholder="Enter Your Sub Category Name">
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

                    
                    
                    <br> <br>
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
    axios.get('/api/category/')
    .then(({data}) => (this.categories = data))
  },

    data(){
    return {
      form:{
        category_name: null,
        category_link: null,
        category_id: null,
         sub_category:{}
      },
     
      errors:{},
      categories:{},
      
    }
  },

  

    methods:{
    categoryInsert(){
      axios.post('/api/category',this.form)
      .then(() => {
        this.$router.push({name : 'category'})
        Notification.success()
      })
      .catch(error =>this.errors = error.response.data.errors)
      
    },

    fetchData(){
      let id = event.target.value;
      axios.get('/api/fetch/data/'+id)
     .then((response) => (this.form.sub_category = response.data))
    }
  }

}
  

</script>



<style type="text/css">
	

</style>
