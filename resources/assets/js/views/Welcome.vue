<template>
    <div>


        <div class="navbar-fixed-top bg-white bg-primary hidden-md hidden-lg">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <div style="font-size: 11px">
                        <a target="_blank" href="tel:09970488345" style="color: #fff"> <i class="fa fa-phone"></i> : 09970488345</a>
                        <a target="_blank" href="http://www.facebook.com/ntgtechnology" style="color: #fff;"><i class="fa fa-facebook"></i> Facebook</a>
                        <i class="fa fa-address-book"></i> ေမာ္လၿမိဳင္ၿမိဳ႕။
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <img src="ntg/logo.png" class="titleSmallImage">
                </div>
                <div class="col-md-3 hidden-lg hidden-md" style="margin-bottom: 0; padding-bottom: 0;">
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <input v-model="q" @keyup='doSearch' type="text" class="form-control"  placeholder="Search on us ...">
                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

        <div class="navbar-fixed-top bg-white bg-primary hidden-sm hidden-xs">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <div style="margin-top: 20px" class="hidden-xs hidden-sm">

                        <p><a target="_blank" href="tel:09970488345" style="color: #fff"> <i class="fa fa-phone"></i> : 09970488345</a></p>
                        <p><a target="_blank" href="http://www.facebook.com/ntgtechnology" style="color: #fff;"><i class="fa fa-facebook"></i> Facebook</a></p>
                        <p><i class="fa fa-address-book"></i> ေမာ္လၿမိဳင္ၿမိဳ႕။</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <img src="ntg/logo.png" class="titleLargeImage">
                </div>
                <div class="col-md-3 text-left  hidden-xs hidden-sm">
                    <form style="margin-top: 40px">
                        <div class="form-group">
                            <div class="input-group">
                                <input id="searchBox" v-model="q" @keyup='doSearch' type="text" class="form-control"  placeholder="Search on us ...">
                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>




    <div class="container myLargeContainer">
        <div class="col-md-10 col-md-offset-1">

            <div v-if="q.length>0">
                <p class="text-info" v-if="posts.length>0"><span class="glyphicon glyphicon-ok-circle"></span> Your search result  was found. <span class="badge">{{posts.length}}</span></p>
                <p class="text-danger" v-if="posts.length <=0"><i class="fa fa-warning"></i> Your search result wat not found.</p>
            </div>
        <div v-for="post in posts">
            <div class="thumbnail" style=" padding-left: 20px;padding-right: 20px; padding-bottom: 30px; background:  gainsboro">
                <div class="page-header">
                    <router-link :to="'post/' + post.slug"><h3><strong>{{post.title}}</strong></h3></router-link>
                </div>
                <read-more more-str="read more" :text="post.content" link="#" less-str="read less" :max-chars="300"></read-more>
                <hr>
                <p>
                    <small>
                        Post By : <strong>{{post.user.name}}</strong>,
                        On : <strong>{{getMomentTime(post.created_at)}}</strong>
                    </small>
                    <span class="pull-right">
                        <social-sharing :url="'http://192.168.0.104/#/post/'+ post.slug"
                                        :quote="post.title"

                                inline-template>
                            <div>
                                    <network network="facebook" class="btn btn-primary btn-xs">
                                        <i class="fa fa-facebook"></i> Facebook
                                    </network>
                                    <network network="googleplus" class="btn btn-primary btn-xs">
                                        <i class="fa fa-google-plus"></i> Google +
                                    </network>
                                    <network network="line" class="btn btn-primary btn-xs">
                                        <i class="fa fa-line"></i> Line
                                    </network>
                                    <network network="linkedin" class="btn btn-primary btn-xs">
                                        <i class="fa fa-linkedin"></i> LinkedIn
                                    </network>


                                    <network network="skype" class="btn btn-primary btn-xs">
                                        <i class="fa fa-skype" ></i> Skype
                                    </network>


                                    <network network="twitter" class="btn btn-primary btn-xs">
                                        <i class="fa fa-twitter"></i> Twitter
                                    </network>


                            </div>
                         </social-sharing>
                    </span>
                </p>

            </div>
        </div>

            <nav>
                <ul class="pager">
                    <li :class="[{disabled: !pagination.prev_page_url}]" @click="getPosts(pagination.first_page_url)"><a>First</a></li>
                    <li :class="[{disabled: !pagination.prev_page_url}]" @click="getPosts(pagination.prev_page_url)"><a>Previous</a></li>
                    <li><a>{{pagination.current_page}} of {{pagination.last_page}}</a></li>
                    <li :class="[{disabled: !pagination.next_page_url}]" @click="getPosts(pagination.next_page_url)"><a>Next</a></li>
                    <li :class="[{disabled: !pagination.next_page_url}]" @click="getPosts(pagination.last_page_url)"><a>Last</a></li>
                </ul>
            </nav>
        </div>


    </div>


    <div class="panel-footer ">

        <div class="text-center">
            <i>Copyright &copy; {{getMomentYear()}}  </i><b>NTG Technology</b>. All rights
            reserved.
        </div>
    </div>
        <back-to-top bottom="50px" right="50px">
            <button type="button" class="btn btn-info btn-to-top"><span class="glyphicon glyphicon-chevron-up"></span></button>
        </back-to-top>

    </div>
</template>
<script>
    import axios from 'axios';
    import moment from 'moment';
    export default {

        data(){
            return {
                posts: [],
                q: '',
                pagination: {}
            }
        },
        created(){
           this.getPosts();

        },
        methods: {
            doSearch(){
                if(this.q.length > 0) {
                    this.getPosts("api/search/" + this.q);
                }else{
                    this.getPosts();
                }
            },
            getPosts(page_url){
                let vm=this;
                page_url=page_url || "api/posts"
                axios.get(page_url)
                    .then(res=>{this.posts=res.data.posts.data
                    vm.makePagination(res.data.posts);
                    })
                    .catch(err=>console.log(err))
            },
            getMomentTime(post){
                return moment(post).format('MMMM Do YYYY, h:mm:ss A');
            },
            getMomentYear(){
                return moment().format('YYYY');
            },
            makePagination(pd){
                let pagination=
                    {
                        current_page: pd.current_page,
                        last_page:pd.last_page,
                        next_page_url:pd.next_page_url,
                        prev_page_url:pd.prev_page_url,
                        last_page_url:pd.last_page_url,
                        first_page_url:pd.first_page_url
                    }

                this.pagination=pagination
            }

        }

    }

</script>

<style>
    #searchBox{
        height: 40px;


    }

    body {
        background: #f5f5f4;
    }

    .titleLargeImage{
        width: 120px;
        padding: 2px;

    }

    .myLargeContainer{
        margin-top: 140px;
        margin-bottom: 20px;
    }
    .titleSmallImage{
        width: 70px;
        padding: 2px;

    }
    nav ul li {
        cursor: pointer;
    }

</style>
