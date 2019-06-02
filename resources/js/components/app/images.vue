<template>
	<div class="card">
		<div class="card-header">
			Images Table
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				  New Image
				</button>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-info text--white" @click="changeDir('a')">Counselling</button>
					</div>
					<div class="col-md-6">
						<button class="btn btn-warning" @click="changeDir('b')">Contraindications</button>
					</div>
				</div>
			</div>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">First</th>
			      <th scope="col">Edit</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr v-for="(i,index) in items" :key="index">
			      <th scope="row">{{i}}</th>
			      <td><img :src="'images/' + dir + '/' + i" alt="" class="img-fluid"></td>
			      <td><button class="btn btn-info btn-dark" @click="changeImage(i,index)">Edit</button></td>
			    </tr>
			  </tbody>
			</table>
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
			    <li class="page-item"><a class="page-link" href="#" v-if="data.current_page != 1" @click="() => {page= page -1; install();}">Previous</a></li>
			    <li class="page-item"><a class="page-link" href="#" @click="() => {page= page +1; install();}">Next</a></li>
			  </ul>
			</nav>
			<div class="fileI">
				<input type="file" ref="image" v-on:change="onFileChange">
			</div>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">New Image</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-success" role="alert" v-show="showAlert">
				  Add Success
				</div>
		        <div class="form-group">
				    <label for="exampleInputEmail1">Number</label>
				    <input type="text" class="form-control"  v-model="newImage.id"  placeholder="Enter Image Number">
				    <small class="form-text text-muted">Please Type in Number Just without specal element or space just number</small>
				 </div>
				 <div class="form-group">
				    <label for="exampleFormControlSelect1">Select Place</label>
				    <select class="form-control" id="exampleFormControlSelect1" v-model="newImage.dir">
				      <option value="a">Counselling</option>
				      <option value="b">Contraindications</option>
				    
				    </select>
				  </div>
		      </div>
		      <div class="form-group">
		      		<label for="exampleInputEmail1">Select The image With png Only</label>
				    <input type="file" class="form-control" v-on:change="onFileChangeNew">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" @click="newImageMethod">Save changes</button>
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
				items:[],
				data:[],
				page:1,
				selectID:0,
				selectINDEX:0,
				image:'',
				dir:'a',
				newImage:{id:0,image:'',dir:''},
				showAlert:false
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.post('/api/images/index?page='+vm.page,{dir:vm.dir}).then(response => {
					vm.items = response.data.data;
					vm.data = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			changeImage(id,index) {
				const vm = this;
				var id = id.split('.');
				vm.selectID = id[0];
				vm.selectINDEX = index;
				vm.$refs.image.click();
			},
			onFileChange(e) {
		    	let files = e.target.files || e.dataTransfer.files;
		        if (!files.length)
		          return;
		        this.createImage(files[0]);
		    },
		    createImage(file) {
		     let reader = new FileReader();
		      let vm = this;
		      reader.onload = (e) => {
		          vm.image = e.target.result;
		          vm.updateImage();
		      };
		      reader.readAsDataURL(file);
		   },
		   onFileChangeNew(e) {
		    	let files = e.target.files || e.dataTransfer.files;
		        if (!files.length)
		          return;
		        this.createImageNew(files[0]);
		    },
		    createImageNew(file) {
		     let reader = new FileReader();
		      let vm = this;
		      reader.onload = (e) => {
		          vm.newImage.image = e.target.result;
		      };
		      reader.readAsDataURL(file);
		   },
		   updateImage() {
		   	const vm = this;
		   	axios.post('api/images/store',{image:vm.image,id:vm.selectID,dir:vm.dir}).then(response =>{
		   		location.reload();
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   changeDir(dir) {
		   	const vm = this;
		   	vm.dir = dir;
		   	vm.page = 1;
		   	vm.items= [];
		   	vm.data =[];
		   	setTimeout(() => {
		   		vm.install();
		   	},200);
		   },
		   newImageMethod() {
		   	const vm = this;
		   	axios.post('api/images/newImage',vm.newImage).then(response => {
		   		vm.showAlert = true;
		   		setTimeout(() => {
		   			location.reload();
		   		},1500);
		   	}).catch(err => {
		   		console.log(err);
		   	});
		   }
		},
		mounted() {
			const vm = this;
			vm.install();
		}
	}
</script>
<style>
	.fileI{position: fixed; left: -99999px;}
</style>