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


        <div  class="container myLargeContainer">

            <div class="col-md-10 col-md-offset-1">
                <div class="text-center" style="font-size: 16px; margin-bottom: 5px"> <router-link to="/" ><i class="fa fa-home"></i> Home</router-link></div>

                <div class="thumbnail" style="background: gainsboro; padding-left: 20px;padding-right: 20px; padding-bottom: 30px">
                    <div class="page-header">
                       <a><h3><strong>{{post.title}}</strong></h3></a>
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
                                        :quote="post.slug"

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
        </div>


        <div class="panel-footer">
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

    import moment from 'moment'

    export default {
        props: ['slug'],
        data(){
            return{
                post: ''
            }
        },
        created(){
            this.getPost();
        },
        methods: {
            getPost(){
              axios.get('api/post/' + this.slug)
                  .then(res=>{this.post=res.data.post})
                  .catch(err=>console.log(err))
            },
            getMomentTime(post){
                return moment(post).format('MMMM Do YYYY, h:mm:ss A');
            },
            getMomentYear(){
                return moment().format('YYYY');
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
    .titleSmallImage{
        width: 70px;
        padding: 2px;

    }

    .myLargeContainer{
        margin-top: 140px;
        margin-bottom: 20px;
    }
</style>
