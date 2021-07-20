function data_show(){
    const app={
        data(){
            return{
                
                picture:food_obj[0].Img_Path,
                ID:food_obj[0].ID,
                Name:food_obj[0].Name,
                Unit:food_obj[0].Unit,
                Freeze:food_obj[0].Freeze,
                Class:food_obj[0].Class,
                Input_Date:food_obj[0].Input_Date,
                Vali_Date:food_obj[0].Vali_Date,
                Dead_Line:food_obj[0].Dead_Line,
                action:food_obj[0].Show,
                edit_href:"route.php?id="+food_obj[0].ID+"&act=edit",
                del_href:"route.php?id="+food_obj[0].ID+"&act=delete"

            }
        }
        
    }
    Vue.createApp(app).mount('#datail');
}

function chg_img(){
    var img = document.getElementById('upload_img').files[0];
    var img_src=window.URL.createObjectURL(img);
    document.getElementById('img_view').src=img_src;
}