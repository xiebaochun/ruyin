/**
 * @author star
 */
/*-----------------------------------微信分享  页面分享--------------------------*/
var dataForWeixin={		
		img:  'http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_18_02.png', //带加
		url:	'http://test.activity.sinreweb.com/TyRyBottleInChina/Wx/index',
        title:	'#统一如饮【瓶上中国】#',
        desc:	"秀出最美中国风。小伙伴们快来戳一下我的作品，投票也能赢大奖！"
};
var weixin={
	data:{debug:false,appId:'',timestamp:'',nonceStr:'',signature:'',jsApiList:[ 'checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','hideMenuItems','showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','translateVoice','startRecord','stopRecord','onRecordEnd','playVoice','pauseVoice','stopVoice','uploadVoice','downloadVoice','chooseImage','previewImage','uploadImage','downloadImage','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu','closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard']},
	get:function(){
		weixin.images={localId: [], serverId: []};
		weixin.voice={localId:'',serverId:''};				
		//if(/micromessenger/gi.test(navigator.userAgent.toLowerCase())){			
			$.get('http://game.sinreweb.com/Game/JsConfig/getSignPackage',{url:location.href},function(res){				
				if(res.err==0){
					//console.log(res)
					weixin.data.appId=res.appId;
					weixin.data.timestamp=res.timestamp;
					weixin.data.nonceStr=res.nonceStr;
					weixin.data.signature=res.signature;
					weixin.init();
				}
			},'jsonp');
		//}
	},
	init:function(){
		wx.config(weixin.data);
		wx.ready(function(){
			//weixin.checkJsApi();
			//alert('ready')
			weixin.bind();			
		})		
	},checkJsApi:function(call){//是否支持  回调参数res  bool:是否支持
		wx.checkJsApi({jsApiList: ['getNetworkType','previewImage'],success:function(res){			
			call && call(res,res.errMsg.indexOf('ok')>-1);
		}})
	},//分享到朋友圈 
	MenuShareTimeline:function(success,cancel,url,title,img,desc){
		//weixin.set_weixin(url,title,img,desc)
		wx.onMenuShareTimeline({
           title: dataForWeixin.title,
           link: dataForWeixin.url,
           imgUrl: dataForWeixin.img,
           desc:dataForWeixin.desc,
           trigger: function (res) {
             // alert('用户点击分享到朋友圈');
           },
           success: function (res) {
               //alert('已分享');
               success && success(res);
           },
           cancel: function (res) {
               //alert('已取消');
               cancel && cancel(res);
           },
           fail: function (res) {
               //alert(JSON.stringify(res));
           }
        });
		//alert('已注册获取“分享到朋友圈”状态事件')
	},MenuShareQQ:function(success,cancel,url,title,img,desc){//分享到QQ
		weixin.set_weixin(url,title,img,desc)
		wx.onMenuShareQQ({
           title: dataForWeixin.title,
           link: dataForWeixin.url,
           imgUrl: dataForWeixin.img,
           desc:dataForWeixin.desc,
           trigger: function (res) {
               //alert('用户点击分享到QQ');
           },
           complete: function (res) {
               //alert(JSON.stringify(res));
           },
           success: function (res) {
              //alert('已分享');
               success && success(res);
           },
           cancel: function (res) {
               //alert('已取消');
               cancel && cancel(res);
           },
           fail: function (res) {
              // alert(JSON.stringify(res));
           }
       });
       //alert('已注册获取“分享到 QQ”状态事件');
	},MenuShareAppMessage:function(success,cancel,url,title,img,desc){//发送给朋友
		 weixin.set_weixin(url,title,img,desc)
		 wx.onMenuShareAppMessage({
             title: dataForWeixin.title,
             link: dataForWeixin.url,
             imgUrl: dataForWeixin.img,
             desc:dataForWeixin.desc,
             trigger: function (res) {
               //alert('用户点击发送给朋友');
             },
             success: function (res) {
               //alert('已分享');
               success && success(res);
             },
             cancel: function (res) {
               //alert('已取消');
               cancel && cancel(res);
             },
             fail: function (res) {
               //alert(JSON.stringify(res));
             }
        });
        //alert('已注册获取“发送给朋友”状态事件');
	},MenuShareWeibo:function(success,cancel,url,title,img,desc){//分享到微博
		weixin.set_weixin(url,title,img,desc)
		wx.onMenuShareWeibo({
            title: dataForWeixin.title,
            link: dataForWeixin.url,
            imgUrl: dataForWeixin.img,
            desc:dataForWeixin.desc,
            trigger: function (res) {
                //alert('用户点击分享到微博');
            },
            complete: function (res) {
              //alert(JSON.stringify(res));
            },
            success: function (res) {
              //alert('已分享');
              success && success(res);
            },
            cancel: function (res) {
              //alert('已取消');
              cancel && cancel(res);
            },
            fail: function (res) {
              //alert(JSON.stringify(res));
            }
       });
       // alert('已注册获取“分享到微博”状态事件');
	},chooseImage:function(call){
		wx.chooseImage({
           success: function (res) {
           	 
           	 weixin.images.localId=res.localIds;// 保存本地图片的id 由 微信提供的  数组中的内容可以直接赋值到src    微信会去解析地址显示成图片
           	 call && call(res);
           	 return ;
           	 for(var i=0;i<res.localIds.length;i++){
           	 	var img=$('<img src='+res.localIds[i]+'  style="width:30px;" id="id_img_'+i+'">')
           	 	$('body').append(img);           	 	
           	 	$('body').append(res.localIds[i])
           	 }
           	 //alert($('#id_img_0').attr('src'));
           	 // $('body').append(JSON.stringify(res))
              //images.localId = res.localIds;             
              
            }
       });
	},uploadImage:function(){
		if(weixin.images.localId.length==0){
			//alert('请先选择图片');
			return ;
		}
		var i=0,length=weixin.images.localId.length,data=[];
		i=length-1;
		function upload(){
			wx.uploadImage({
				localId:weixin.images.localId[i],
				isShowProgressTips:0,
				success:function(res){
					//i++;
					//alert('已上传'+i+res.serverId);
					weixin.images.serverId.push(res.serverId);//返回的是服务器图片的id
					//weixin.images.serverId=res.serverId;
					$('#id_base64').val(res.serverId);
					//alert(res.serverId);
					//$('body').append($('<img src='+res.serverId+' style="height:20px;">'))
					//if(i<length){
						//upload();
					//}
				},fail:function(res){
					console.log(JSON.stringify(res));
				}
			})
		}
		upload();		
	},download:function(){//获取图片是传递服务器的id返回本地图片的id,和chooseImage返回的是一样的。
		if(weixin.images.serverId.length === 0) {
	   	    alert('请先使用 uploadImage 上传图片')
	  	 	return ;	
		}
		var i=0,length=weixin.images.serverId.length;
		function download(){
			wx.downloadImage({
		  	    serverId: weixin.images.serverId[i],
		   	 	success:function(res){
		    		i++;		    		
		    		var img=$('<img src='+res.localId+'  style="width:30px;" id="id_img_s'+i+'">')
		    		$('body').append(img)
		    		$('body').append(res.localId)
		    		//alert(JSON.stringify(res))
		    		if(i<length){
		    			download();
		    		}
		    	}
	    	})
		}
	    download();
	},startRecord:function(success,cancel){//开始录音  参数：成功  失败 回调
		wx.startRecord({
			cancel:function(){
				cancel && cancel();
				console.log('用户拒绝授权录音')
			},success:function(){
				success && success();
				console.log('用户授权了')
			}
		})
		weixin.VoiceRecordEnd();
	},stopRecord:function(success,fail){//停止录音  参数：成功  失败回调
	    wx.stopRecord({
			success:function(res){
				if(success){
					success(res);
				}else{
					weixin.voice.localId = res.localId;
				}					
			},fail:function(res){
				fail && fail(res);
				console.log(JSON.stringify(res));
			}
		})
	},VoiceRecordEnd:function(){//监听录音自动停止 
		wx.onVoiceRecordEnd({
			complete:function(res){
				weixin.voice.localId = res.localId;
                console.log('录音时间已超过一分钟');
			}
		});		
	},playVoice:function(obj){//播放音频   会保留id到 weixin.playid
	    	if(obj==''){
	    		//alert('请先录音');
	    		console.log('没有声音可以播放')
	    		return ;
	    	}
	    	weixin.playid=obj;
	    	wx.playVoice({
	    		localId: obj
	    	})
	    	weixin.VoicePlayEnd();
	},pauseVoice:function(){//暂停播放   会判断weixin.playid
		if(weixin.playid){
			wx.pauseVoice({
             localId: weixin.playid
            });
		}		 
	},stopVoice:function(){//停止播放，再开始时从头播放     
		if(weixin.playid){
		    wx.stopVoice({
			    localId: weixin.playid
		    })
		}
	},VoicePlayEnd:function(){//监听录音播放停止
		wx.onVoicePlayEnd({
			complete:function(res){
				alert('录音'+res.localId+'播放结束');
			}
		})
	},uploadVoice:function(success,obj){//上传语音  参数：回调  上传id
		if(obj ){
			if(obj==''){
				alert('请先录音');
				return ;
			}
			weixin.voice.localId=obj;
		}else{
			if(weixin.voice.localId==''){
				alert('请先录音');
				return ;
			}
		}
		upload(weixin.voice.localId)
		function upload(id){
			wx.uploadVoice({
				localId:id,success:function(res){
					alert('上传语音成功,serverId='+res.serverId);
					weixin.voice.serverId = res.serverId;
					success && success(res);
				}
			})
		}
		
	},downloadVoice:function(success,obj){//下载服务器语音  参数：成功回调   下载的服务器语音id
		if(obj){
			if(obj==''){
				alert('请确认下载的语音服务器id');
				return ;
			}
			weixin.voice.serverId = obj
		}
		if(weixin.voice.serverId ==''){
			alert('请确认下载的语音服务器id');
			return ;
		}
		wx.downloadVoice({
			 serverId: weixin.voice.serverId,
			 success:function(res){
			 	alert('下载语音成功localId='+res.localId);
			 	weixin.voice.localId = res.localId;
			 	success && success(res);
			 }
		})
	},translateVoice:function(success,obj){//识别音频  根据本地语音识别字
		if(obj){
			if(obj==""){
				alert('请埴写本地语音id');
				return ;
			}
			weixin.voice.localId=obj;
		}
		if(weixin.voice.localId==''){
			alert('请先录音或传递本地语音id');
			return ;
		}		
		wx.translateVoice({
            localId: weixin.voice.localId, // 需要识别的音频的本地Id，由录音相关接口获得
            isShowProgressTips: 1, // 默认为1，显示进度提示
            success: function (res) {
                alert(JSON.stringify(res)); // 语音识别的结果
                success && success(res);
            }
        });		
	},networkType:function(success){ //获取网络类型  2g 3g 4g wifi   
	    wx.getNetworkType({
            success: function (res) {
                weixin.networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
                success && success(res)
            },fail:function(res){
            	console.log(JSON.stringify(res));
            }
        });
	},openLocation:function(data){  //查看地理位置
		 wx.openLocation({
             latitude: (data && data.w) || 23.099994,
             longitude: (data && data.j) || 113.324520,
             name: (data && data.name) || 'TIT 创意园',
             address: (data && data.address) || '广州市海珠区新港中路 397 号',
             scale: (data && data.scale) || 14,
             infoUrl: (data && data.url) || 'http://www.wangyuanwd.com' //更多的链接
         });
	},getLocation:function(success,cancel){ //获取位置     成功回调第二参数是否成功
		wx.getLocation({
			success:function(res){
				console.log(JSON.stringify(res));
				success && success(res,res.errMsg.indexOf('ok')>-1);							
			},cancel:function(res){
				weixin.locationcancel=true;//得到拒绝
				console.log('用户拒绝获取位置'+JSON.stringify(res))
				cancel && cancel(res);
			}
		})
	},hideOptionMenu:function(){//隐藏右上角菜单
		 wx.hideOptionMenu();
	},showOptionMenu:function(){//显示右上角菜单
		wx.showOptionMenu();
	},hideMenuItems:function(success,list){//批量隐藏  参数：数组   回调
		wx.hideMenuItems({
			menuList:lists || [
			     'menuItem:readMode', // 阅读模式
			     'menuItem:share:timeline', // 分享到朋友圈
			     'menuItem:copyUrl' // 复制链接
			],
			success:function(res){
				console.log('批量隐藏成功'+JSON.stringify(res));
				success && success(res);
			},fail:function(res){
				alert(JSON.stringify(res));
			}
		});
	},showMenuItems:function(success,list){ //批量显示菜单 
		wx.showMenuItems({
			menuList:lists || [
			     'menuItem:readMode', // 阅读模式
			     'menuItem:share:timeline', // 分享到朋友圈
			     'menuItem:copyUrl' // 复制链接
			],
			success:function(res){
				console.log('批量隐藏成功'+JSON.stringify(res));
				success && success(res);
			},fail:function(res){
				alert(JSON.stringify(res));
			}
		});
	},hideAllNonBaseMenuItem:function(){ //隐藏所有非基本菜单
		 wx.hideAllNonBaseMenuItem({
		     success:function(res){
		     	alert('已隐藏所有非基本菜单项'+JSON.stringify(res));
		     }
		 });
	},showAllNonBaseMenuItem:function(){//显示所有非基本菜单
		wx.showAllNonBaseMenuItem({
		     success:function(res){
		     	alert('已隐藏所有非基本菜单项'+JSON.stringify(res));
		     }
		 });
	},closeWindow:function(){//关闭当前窗口
		 wx.closeWindow();
	},scanQRCode:function(success){//扫一扫  在打开扫一扫时会回调
		wx.scanQRCode({
            desc: 'scanQRCode desc',
            needResult:0,// 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            success:function(res){
            	alert(res.errMsg);
            	success && success (res);
            }
            
       });
	},openProductSpecificView:function(id,type){  //跳转到商品页
		wx.openProductSpecificView({
            productId: id || 'pDF3iY_m2M7EQ5EKKKWd95kAxfNw',
            viewType: type || 0
        });
	},chooseCard:function(cardid,time,non,success){//调起适用于门店的卡券列表并获取用户选择列表
		 wx.chooseCard({
             cardSign: cardid || '97e9c5e58aab3bdf6fd6150e599d7e5806e5cb91',
             timestamp: time || 1417504553,
             nonceStr: non || 'k0hGdSXKZEj3Min5',
             success: function (res) {
                  alert('已选择卡券：' + JSON.stringify(res.cardList));
                  success && success(res);
             }
        });
	},addCard:function(list,success){//添加卡券   卡券数组   回调
		var list = list || [{cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'}]
		wx.addCard({
            cardList:list,
            success: function (res) {
                 //alert('已添加卡券：' + JSON.stringify(res.cardList));
                 success &&　success(res);
            }
         });
	},bind:function(){			
		
		//$('#span_1').on('click',function(){
			weixin.checkJsApi(function(res,bool){				
						
				if(bool==false){
					//alert('false')
					weixin.weixinbind();
				}	
			})
		//})		
		//$('#span_2').on('click',function(){
			weixin.MenuShareTimeline(function(res){
				//alert('分享到朋友圈成功')
			},function(){
				//alert('取消分享到朋友圈')
			});
		//})
		//$('#span_3').on('click',function(){
			weixin.MenuShareQQ(function(res){
				//alert('分享到qq')
			},function(){
				//alert('取消分享到qq')
			});		   
		//})
		
		weixin.MenuShareAppMessage(function(){
			//alert('分享到朋友')
		},function(){
			//alert('取消分享到朋友')
		})
		
		
		//$('#span_5').on('click',function(){
			weixin.MenuShareWeibo(function(res){
				alert('分享到朋友微博')
			},function(){
				alert('取消分享到微博')
			});
		//})
		//选择本地或拍照图片
		$('#span_6').on('click',function(){
			weixin.chooseImage(function(res){				
				for(var i=0;i<res.localIds.length;i++){
           	 	   var img=$('<img src='+res.localIds[i]+'  style="width:30px;" id="id_img_'+i+'">')
           	 	   $('body').append(img);           	 	
           	    }
			});
		})
		//预览图片
		$('#span_7').on('click',function(){
			var curr=$(this).data('imgcurrnet');
			var imgs=$(this).data('imgs').split(',');
		    wx.previewImage({
               current: curr,
               urls: imgs
           });		    
		})
		$('#span_8').on('click',function(){
			weixin.uploadImage()
		})
		$('#span_9').on('click',function(){
			weixin.download();
		})
		
	}
}


//修改微信分享url
weixin.weixin_url=function(url){
	dataForWeixin.url=url
}//修改微信分享img
weixin.weixin_img=function(img){
	dataForWeixin.img=img
}//修改微信分享title
weixin.weixin_title=function(title){
	dataForWeixin.title=title
}//修改微信分享desc
weixin.weixin_desc=function(desc){
	dataForWeixin.desc=desc
}
weixin.set_weixin=function(url,title,img,desc){
	url && weixin.weixin_url(url);	
	title && weixin.weixin_title(title);
	img && weixin.weixin_img(img);
	desc && weixin.weixin_desc(desc);	
}
//微信分享title img desc 绑定
weixin.weixinbind=function(){		
		var onBridgeReady=function(){				
			// 发送给好友;
			WeixinJSBridge.on('menu:share:appmessage', function(argv){				
				WeixinJSBridge.invoke('sendAppMessage',{
					"appid":		dataForWeixin.appId,
					"img_url":		dataForWeixin.img,
					"img_width":	"120",
					"img_height":	"120",
					"link":				dataForWeixin.url,
					"desc":				dataForWeixin.desc,
					"title":			dataForWeixin.title
				}, function(e){ 
					//_report(link, fakeid, 1)
					"send_app_msg:cancel" != e.err_msg && "share_timeline:cancel" != e.err_msg && Main.sinacall()
				});
			});
			// 分享到朋友圈;
			WeixinJSBridge.on('menu:share:timeline', function(argv){				
				WeixinJSBridge.invoke('shareTimeline',{
				"img_url":dataForWeixin.img,
				"img_width":"120",
				"img_height":"120",
			"link":dataForWeixin.url,
				"desc":dataForWeixin.desc,
				"title":dataForWeixin.desc
				}, function(e){
					"send_app_msg:cancel" != e.err_msg && "share_timeline:cancel" != e.err_msg && Main.sinacall()
	            });
			});
			// 分享到微博;
			WeixinJSBridge.on('menu:share:weibo', function(argv){				
				WeixinJSBridge.invoke('shareWeibo',{
				"content":dataForWeixin.title+' '+dataForWeixin.url,
				"url":dataForWeixin.url
				}, function(res){	
	            });
			});
			// 分享到Facebook
			WeixinJSBridge.on('menu:share:facebook', function(argv){				
				WeixinJSBridge.invoke('shareFB',{
				"img_url":dataForWeixin.img,
				"img_width":"120",
				"img_height":"120",
				"link":dataForWeixin.url,
				"desc":dataForWeixin.desc,
				"title":dataForWeixin.title
				}, function(e){
					"send_app_msg:cancel" != e.err_msg && "share_timeline:cancel" != e.err_msg && Main.sinacall()
	            });
			});
			//显示微信右上角工具
			WeixinJSBridge.call("showOptionMenu");
		};
		if(document.addEventListener){
			document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
		}else if(document.attachEvent){
			document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
			document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
		}else{
			onBridgeReady();
		}		
}
$(function(){	
	weixin.get();	
})
