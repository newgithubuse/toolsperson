<template>
 
  <div class="container border">
    <h1>
        會員註冊
    </h1> 
    <form @submit.prevent="validateBeforeSubmit">     
      <div class="form-col">
        <div class="form-group col-7">
          <label for="email">Email address</label>        
          <input
            v-validate="{ required: true, email: true }"
            data-vv-as="email"
            name="email"          
            type="email"
            class="form-control"                     
            placeholder="Enter email"     
            v-model="email"
            :class="{'input': true, 'is-danger': errors.has('email') }"                   
          >                     
          <div class="alert alert-danger"
            v-show="errors.has('email')"
            >
            {{ errors.first('email') }}
          </div>
        </div>
        <div class="form-group col-7">
          <label for="Password">Password</label>
            <input
              v-validate="{required : true ,alpha_num : true ,min : 8 ,max : 16}"            
              name="password"
              type="password"
              class="form-control"            
              placeholder="Password"
              v-model="password"
            >
            <div class="alert alert-danger"
              v-show="errors.has('password')"
              >
              {{ errors.first('password') }}
            </div>                          
        </div>

        <div class="form-group col-7">
          <label for="Password">Password Again</label>
            <input 
              v-validate="{required : true ,is : password}"
              name="password_confirmation"
              type="password"
              class="form-control"          
              placeholder="Password Again"         
            >
            <div class="alert alert-danger"
              v-show="errors.has('password_confirmation')"
              >
            {{ errors.first('password_confirmation') }}
            </div>                          
        </div>   
        
        <div class="form-group col-6">
          <label for="name">name</label>
            <input
              v-validate="{ required: true ,min : 2, max : 10}"
              name="name"
              type="name"
              class="form-control"            
              placeholder="name"                       
            >
            <div class="alert alert-danger"
              v-show="errors.has('name')"
              >
            {{ errors.first('name') }}
            </div>      
        </div>
        <div class="form-group col-6">
          <label for="phone">phone</label>
            <input
              v-validate="{ required: true ,numeric : true ,length : 10}"
              name="phone"
              type="tel"
              class="form-control"            
              placeholder="Phone"                                               
            >
          
          <div class="alert alert-danger"
              v-show="errors.has('phone')"
              >
            {{ errors.first('phone') }}
          </div>           
          <small         
                style="color:Orange"
              >       
              ex:09xxxxxxxx
          </small>
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>          
      </div>
    </form>
    
  </div>
</template>
<style scope>
  h1{
    padding: 30px;
  }
  .container{
    width: 40%;
  }  
</style>

<script>
export default {  
  data: () => ({
    email: '',
    name: '',
    phone: '',
  }),
  methods: {
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          
          alert('登入成功!');
          return;
        }

        alert('請確認格式正確!');
      });
    }

  }

};
</script>






