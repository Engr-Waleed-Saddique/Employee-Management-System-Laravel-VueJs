<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Employees</h1>
    </div>
    <div class="row">
      <div class="card mx-auto">
        <div>
          <div v-if="showMessage" class="alert alert success">{{message}}</div>
        </div>
        <div class="card-header">
          <div class="row">
            <div class="col">
              <form>
                <div class="form-row align-item-center">
                  <div class="col">
                    <input
                      type="search"
                      v-model="search"
                      name="search"
                      class="form-control"
                      id="autoSizingInput"
                      placeholder="Jane Doe"
                    />
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-primary">
                      Submit
                    </button>
                  </div>
                  <div class="col">
                    <select
                        v-model="selectedDepartment"
                        name="city"
                        class="form-control"
                        aria-label="Default select example"
                      >
                        <option
                          v-for="department in departments"
                          :key="department.id"
                          :value="department.id"
                        >
                          {{ department.name }}
                        </option>
                      </select>
                  </div>
                </div>
              </form>
            </div>
            <div>
              <router-link :to="{name:'EmployeesCreate'}" class="btn btn-primary mb-2">Create</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Address</th>
                <th scope="col">Department</th>
                <th scope="col">Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="employee in employees" :key="employee.id">
                <th scope="row">{{employee.id}}</th>
                <td>{{employee.first_name}}</td>
                <td>{{employee.last_name}}</td>
                <td>{{employee.address}}</td>
                <td>{{employee.department.name}}</td>
                <td>
                  <router-link :to="{name:'EmployeesEdit',params:{id:employee.id}}" class="btn btn-success">Edit</router-link>
                  <button class="btn btn-danger" @click="deleteEmployee(employee.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Edit from './Edit.vue';
export default {
  components: { Edit },
  data(){
  return {
    employees:[],
    showMessage:false,
    message:'',
    search:null,
    selectedDepartment:null,
    departments:[]
}
},
watch:{
  //watch function to check if property value is changed then function inside code will run.Here we make search function
  //which means on changing of search property value this function is called.
  search(){
    this.getEmployees();
  },
  selectedDepartment(){
    this.getEmployees();
  }
},
created(){
  this.getEmployees();
  this.getDepartments();
},
methods:{
  getEmployees(){
    axios.get('/api/employees',{params:{
      search:this.search,
      department_id:this.selectedDepartment
    }})
    .then(res=>{
      this.employees=res.data.data
    }).catch(error=>{
      console.log(console.error());
    })
  },
  deleteEmployee(id){
    axios.delete("/api/employees/"+id).then(res=>{
      this.showMessage=true;
      this.message=res.data
      this.getEmployees();
    })
  },
  getDepartments() {
      axios
        .get("/api/employees/departments")
        .then((res) => {
          this.departments = res.data;
        })
        .catch((error) => {
          console.log(console.error);
        });
    }
}
};
</script>
<style>
</style>
