function navbar_show(){
    const navshow={
        template:
        `<nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">冰箱儲藏紀錄</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="expired.html">已刪除紀錄</a></li>
                    </ul>
                </div>
            </div>
        </nav>`
    }
    const app = Vue.createApp({
        components: {
            'navbar': navshow
        }
    })
    
    app.mount('#draw_nav')
}


