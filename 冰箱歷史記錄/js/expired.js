function detail(){

    const app ={
        data(){
            return{
                food_ary:[],
                page_count:0,
                now_page:0,
                page_on:"active",
            }
        },
        methods:{
            food_data(page){
                axios
                .get("expired_data.php?&page="+page)//iputdate asc
                .then( (response)=>{
                    this.food_ary = response.data.list;
                    this.page_count = response.data.page_total;
                    this.now_page = response.data.page_now;
                })
                .catch(function (error) { 
                    console.log(error);
                });

            }

        },
        mounted () {
            this.food_data(1);
        }  
    }
    Vue.createApp(app).mount('#food_table');

}              
