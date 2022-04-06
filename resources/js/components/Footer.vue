<template>
    <footer>
        <div class="footer_wrapper">
            <div class="container">
                <div class="row row-cols-xs  row-cols-lg-3">
                    <div class="col my-3">
                        <!-- footer col -->
                        <div class="footer_col p-2 m-auto">
                            <h5 class="mb-4 text-center">{{firstSection.title}}</h5>
                            <ul>
                                <li v-for="(link,index) in firstSection.links" :key="index">
                                    <span class="card-icons"><i class="fas fa-pizza-slice"></i></span>
                                    <a :href="link.href" target="_blank">{{link.name}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- footer col -->
                    </div>
                    <div class="col my-3">
                        <!-- footer col -->
                        <div class="footer_col p-2 m-auto">
                            <h5 class=" text-center mb-4">{{secondSection.title}}</h5>
                            <ul>
                                <li v-for="(link,index) in secondSection.links" :key="index" >
                                    <span class="card-icons"><i class="fas fa-pizza-slice"></i></span>
                                    <a :href="link.href" target="_blank">{{link.name}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- footer col -->
                    </div>
                    <div class="col my-3">
                        <!-- footer col -->
                        <div class="footer_col p-2 m-auto">
                            <h5 class=" text-center mb-4">{{thirdSection.title}}</h5>
                            <ul>
                                <li v-for="(link,index) in thirdSection.links" :key="index">
                                    <span class="card-icons"><i class="fas fa-pizza-slice"></i></span>
                                    <a :href="link.href" target="_blank">{{link.name}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- footer col -->
                    </div>
                </div>
            </div>
            <!-- end container -->
            <!-- footer bottom -->
            <div class="footer_bottom">
                <div class="container">
                    <div class="bottom_icons">
                        <div class="icon">
                            <a href="https://it-it.facebook.com/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                        <div class="icon">
                            <a href="https://www.linkedin.com/home">
                                <i class="fab fa-linkedin" target="_blank"></i>
                            </a>
                        </div>
                        <div class="icon">
                            <a href="https://github.com/" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end footer bottom -->
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer',
    data:function(){
        return{
             firstSection:{
        title:"Scopri Deliveboo",
        links:[
          {
            name:'Chi siamo',
            href:"http://127.0.0.1:8000/chi-siamo"
          },
          {
            name:'Lavora con noi',
            href:'http://127.0.0.1:8000/lavora-con-noi',
          },
          {
            name:'Ristoranti',
            href:'/#',
          },
          {
            name:'Diventa nostro partner',
            href:'/#',
          },
          
        ],
      },
      // end first section

          secondSection:{
        title:"Social",
        links:[
          {
            name:'Facebook',
            href:"https://it-it.facebook.com/"
          },
          {
            name:'GitHub',
            href:'https://github.com/',
          },
          {
            name:'Linkedin',
            href:'https://www.linkedin.com/home',
          },
          {
            name:'Twitter',
            href:'https://twitter.com/',
          },
          {
            name:'Instagram',
            href:'https://www.instagram.com',
          },
          
        ],
      },
      // end second section

        thirdSection:{
        title:"Note legali",
        links:[
          {
            name:'Contatti',
            href:"/#"
          },
          {
            name:'FAQ',
            href:'/#',
          },
          {
            name:'Tipi di cucina',
            href:'/#',
          },
          
        ],
      },
      // end third section
        }
        
    },
}
</script>

<style lang="scss" scoped>
@import '../../sass/app.scss';
footer{
    color:$page_other_color;
    
        .footer_wrapper{
            width:100%;
            padding-top: 60px;
            background: rgb(0,1,3);
            background: linear-gradient(0deg, rgba(0,1,3,1) 95%, rgba(243,129,50,1) 98%, rgba(124,9,2,1) 100%);
    

        .footer_col {
            width: 250px;
            height: 100%;
            background-color: #3c3a1e;
            border:1px solid $page_other_color;
            border-radius: 10px;
            ul {
                margin-left: -30px;
                li {
                        margin:7px 0;
                    }
                 .card-icons {
                    margin-right: 15px;
                    
                }
            }
        }
        // footer bottom
        .footer_bottom {
            width: 100%;
            border-top:1px solid $page_secondary_color;
            margin-top: 50px;
            
            .bottom_icons{
                width:60%;
                margin: auto;
                padding:50px 0;
                display: flex;
                justify-content: space-around;
                

                .icon{
                    font-size: 30px;
                }
                
                .icon:hover{
                    transform:scale(1.3);
                    transition-delay: 0.5s;
                }
            }
        }
            
    }
}

</style>