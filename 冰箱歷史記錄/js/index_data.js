
function detail(){


    const app ={
        data(){
            return{
                //food_ary:food_obj,
                food_ary:[],
                food_chk:[],
                today:"",
                field:"",
                act:"",
                delta:"icon/down.png",
                triangle:"icon/up.png",
                page_count:0,
                now_page:0,
                page_on:"active",
            }

        },
        methods:{
            food_act(id,act){
                
                window.location.href = "route.php?id="+id+"&act="+act;
            },
            food_del(id){
                var fid ="";
                if(this.food_chk.length>0||id!=undefined){
                    (this.food_chk.length>0)? fid=this.food_chk.join() : fid=id; 
                    const is_del = confirm('確定刪除？');
                    if(is_del){                       
                        return window.location.href = "route.php?id="+fid+"&act=delete";
                    }
                }
            },
            food_sort(key,mode,page){ 

                if(mode=="desc") mode="asc";
                else mode="desc";
                this.food_data(key,mode,page);
                
            },
            food_page(key,mode,page){
                this.food_data(key,mode,page);
            },
            food_data(key,mode,page){

                axios
                .get('index_data.php?sort='+key+','+mode+"&page="+page)//iputdate asc
                .then( (response)=>{
                    this.food_ary = response.data.list;
                    this.today=response.data.today;
                    this.field = response.data.keys;
                    this.act = response.data.act;
                    //console.log("data ",response.data);
                    //console.log("af act "+this.act);
                    this.page_count = response.data.page_total;
                    this.now_page = response.data.page_now;

                })
                .catch(function (error) { // 请求失败处理
                    console.log(error);
                });

            }
            
        },            
        mounted () {
            axios
            .get('index_data.php')
            .then( (response)=>{
              
                this.food_ary = response.data.list;
                console.log("list",response.data.list);
                this.today=response.data.today;
                //console.log("today "+this.today);
                this.field = response.data.keys;
                this.act = response.data.act;
                this.page_count = response.data.page_total;
                this.now_page = response.data.page_now;
                //console.log("total_page "+this.page_total);
                //console.log("now_page "+this.now_page);
                

            })
            .catch(function (error) { // 请求失败处理
                console.log(error);
            });
        }

    }
    
    Vue.createApp(app).mount('#food_table');
    

}
