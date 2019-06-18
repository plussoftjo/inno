<template>
	<div class="vuews">
		<div class="container">
			<div class="card">
			<!-- 	<div class="card-header">
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="active">Active ingredient</label>
							<div class="dropdown ">
								<input type="text" class="form-control" @keyup="search" v-model="load.active">
								<div class="dropdown-content" v-if="show">
									 <p v-for="c in items" @click="() => {load.active = c.active; show=false;}">{{c.active}}</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<button class="btn btn-info btn-block">Search</button>
					</div>
				</div>
				</div> -->
				<div class="card-body">
						<!-- USER TABLE TO GET  -->
		<table class="table table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Active</th>
		      <th scope="col">Bar Code</th>
		      <th scope="col">Trade Name</th>
		      <th scope="col">packaging</th>
		      <th scope="col">Dose</th>
		      <th scope="col">price of the pharmacist</th>
		      <th scope="col">Audience price</th>
		      <th scope="col">Drug Store</th>
		      <th scope="col">Company Name</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(d,index) in data" @click="$router.push({name:'edit',params:{id:d.id}})">
		      <th scope="row">{{d.id}}</th>
		      <td>{{d.active}}</td>
		      <td>{{d.code}}</td>
		      <td>{{d.tradeName}}</td>
		      <td>{{d.paking}}</td>
		      <td>{{d.focus}}</td>
		      <td>{{d.pPrice}}</td>
		      <td>{{d.ppPrice}}</td>
		      <td>{{d.drugStore}}</td>
		      <td>{{d.companyName}}</td>
		    </tr>
		  </tbody>
		</table>
		<!-- END USER TAPLE -->

		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li class="page-item" :class="{disabled: first}"><a class="page-link">Previous</a></li>
		    <li class="page-item" v-if="!first" @click="prev"><a class="page-link" >{{this_page - 1}}</a></li>
		    <li class="page-item active"><a class="page-link" >{{this_page}}</a></li>
		    <li class="page-item" @click="install"><a class="page-link" >{{this_page + 1}}</a></li>
		    <li class="page-item" @click="install"><a class="page-link">Next</a></li>
		  </ul>
		</nav>	
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				show:false,
				items:[],
				load:{active:''},
				page:1,
				first:true,
				last_page:0,
				this_page:0,
				data:[],
				type:null

			}
		},
		methods:{
			search() {
				const  vm = this;
				axios.post('/api/active/search',{search:vm.load.active}).then(response => {
					if(vm.load.active == '') {
						vm.show= false;
					}else {
						if(response.data.length < 1)
						{
							vm.show = false;
						}else {
							vm.show = true;
							vm.items = response.data;
						}
					}
					
				}).catch(err => {
					console.log(err);
				});
			},
			install() {
				const vm = this;
				axios.post('/api/load/index?page=' + vm.page,{id:vm.user.id}).then(response => {
					// Last Page Make 
					vm.last_page = response.data.last_page;

					// INCEWSS PAGE 
					vm.page = vm.page + 1;

					vm.this_page = response.data.current_page;

					if(response.data.current_page == 1)
					{
						vm.first = true;
					}else {
						vm.first = false;
					}

					vm.data = response.data.data;


				}).catch(err => {
					console.log(err)
				})
			},
			prev() {
				const vm = this;
				vm.page = vm.page - 2;
				axios.post('/api/load/index?page=' + vm.page,{id:vm.user.id}).then(response => {
					// Last Page Make 
					vm.last_page = response.data.last_page;

					// INCEWSS PAGE 
					
					vm.page = vm.page + 1;
					vm.this_page = response.data.current_page;

					if(response.data.current_page == 1)
					{
						vm.first = true;
					}else {
						vm.first = false;
					}

					vm.data = response.data.data;



				}).catch(err => {
					console.log(err)
				})
			}
		},
		created() {
			const vm = this;
			vm.install();
			console.log(vm.user);
		},
		props:['user']
	}
</script>
<style>
	.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: block;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 169px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 2px 5px;
    z-index: 1;
    font-weight: 700;
    font-size: 14px;
    text-align: center;
    cursor: pointer;
    color:black;
}
.dropdown-content p:hover {background-color: rgba(0,0,0,0.05);}

.dropdown:hover .dropdown-content {
    display: block;
}
	.title{padding: 5px; text-align: center; font-size: 16px; font-weight: 700;}

</style>