import dashboard from './components/app/dashboard.vue'
import newPharm from './components/app/newPharm'
import submit from './components/app/submit'
import table from './components/app/table'
import edit from './components/app/edit'
import users from './components/app/users'
import newUser from './components/app/newUser'
import login from './components/app/login'
import images from './components/app/images'
export const routes = [
	{
		path:'/',
		name:'dashboard',
		component:dashboard
	},
	{
		path:'/submit',
		name:'Submit',
		component:submit
	},
	{
		path:'/newPharm',
		name:'New',
		component:newPharm
	},
	{
		path:'/table',
		name:'table',
		component:table
	},
	{
		path:'/edit/:id',
		name:'edit',
		component:edit
	},
	{
		path:'/users',
		name:'users',
		component:users
	},
	{
		path:'/newUser',
		name:'newUser',
		component:newUser
	},
	{
		path:'/login',
		name:'login',
		component:login
	},
	{
		path:'/images',
		name:'images',
		component:images
	}
]