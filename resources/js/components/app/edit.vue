<template>
	<div class="pharm">
		<div class="card bg-primary text-white white-text">
			<div class="card-title">
				<div class="title">
					Submit New 
				</div>
			</div>
			<div class="card-body">
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
					<div class="col-md-6">
						<div class="form-group">
							<label for="drug">Drug Store</label>
							<input type="text" class="form-control" v-model="load.drugStore">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="code">code</label>
							<input type="text" id="code" class="form-control" v-model="load.code">
						</div>
					</div>
					<div class="col-md-6">
						<label for="trade">Trade Name</label>
						<input type="text" v-model="load.tradeName" class="form-control">
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-6">
						<label for="paking">packaging</label>
						<input type="text" v-model="load.paking" class="form-control">
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="focus">Dose</label>
							<input type="text" class="form-control" v-model="load.focus">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="price">The price of the pharmacist</label>
							<input type="text" class="form-control" v-model="load.pPrice">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="ppPrice">Audience price</label>
							<input type="text" class="form-control" v-model="load.ppPrice">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="ppPrice">Company Name</label>
							<input type="text" class="form-control" v-model="load.companyName">
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-6">
						<button type="button" class="btn btn-success btn-block" @click="update">Update</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-danger btn-block" @click="destroy">Delete</button>
					</div>
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
				load:{active:'',count:''},
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
			update() {
				const vm = this;
				axios.post('api/load/update/' + vm.$route.params.id,vm.load).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			install() {
				const vm = this;
				axios.get('/api/load/show/' + vm.$route.params.id).then(response => {
					vm.load = response.data;
				}).catch(err => {
					console.log()
				});
			},
			destroy()
			{
				const vm = this;
				axios.get('api/load/destroy/' + vm.$route.params.id).then(response => {
					vm.$router.push({name:'table'});
				}).catch(err => {
					console.log(err);
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
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