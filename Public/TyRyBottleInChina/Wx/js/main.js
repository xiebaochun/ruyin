var Main = {	iscrolls : []};
Main.url = '127.0.0.1/';//ajax请求地址cz.mengniu.sinreweb.com
Main.imgurl='127.0.0.1/Public/TyRyBottleInChina/Wx/'//加载图片请求地址
Main.init = function() {	
	Main.ortchange(); 		  
	window.onresize = function() {		
		//Main.ortchange();	
	}	
	$(document.body).on('touchmove',function(e){
		//e.preventDefault?e.preventDefault():window.event.returnValue = false; 	
	})	
	//旋转	
	/*window.addEventListener('orientationchange',function(){
		//alert(window.orientation)
		// window.orientation  0 正着  左转90  右转-90
	})*/
	Main.On();		
}
Main.ortchange = function(bool) {
	Main.width = $(window).width()
	Main.height = $(window).height();	
	Main.scrollbool=false;	
}
Main.On = function() {	
	$('.link_url').on('touchend',function(e){
		e.preventDefault();
        if($(this).data('share')==1){
            $(".page_f").show();
            return
        }
		location.href=$(this).data('url')
	})
	$('.img_t1').on('click',function(e){
		e.preventDefault();
		$(".nav_top").find('div').toggle();
	})
	$('.but_1').on('touchend',function(e){		
		e.preventDefault();	
		var type=$(this).data('type');		
		 if(type==2){//传图
			if($("#drag_map").find('img').attr('src').length<2 ){
				alert('请选择图片');
				return ;
			}
			Main.canvas2.getnumber();	
			Main.canvas2.post(function(res){
				$('.img_h1').attr('src',res.img)
		        $("#id_box_1").show();
			});
		}	else {//拼图
			if(Main.canvas3.imgarr.length<1){
				alert('请还没有选择素材哦')
				return ;
			}
			Main.canvas3.post(function(res){
				$('.img_d1').attr('src',res.img)
		        $("#id_box_1").show();
			})
		}	
		$('.page_loading').show();				
	})
	$('.but_2').on('touchend',function(e){		
		e.preventDefault();
		var type=$(this).data('type');			
		 if(type==2){
			if($("#drag_map").find('img').attr('src').length<2 ){
				alert('请选择图片');
				return ;
			}
			Main.canvas2.getnumber();			
		}else{
			if(Main.canvas3.imgarr.length<1){
				alert('请还没有选择素材哦')
				return ;
			}
			Main.canvas3.save()
		}	
		$("#id_box_2").show();	
		//
	})
	$(".but_img1").on('click',function(e){
		e.preventDefault();
		if(confirm('确定数据将会被清除')){			
			location.href='?v='+Math.random()*99999;
		}
	})
	$('.but_post').on('touchend',function(e){
		e.preventDefault();
		var title=$("#id_title").val();
		if(title.length<2){
			alert('请正确填写作品名');
			return ;
		}
        if(title.length>6){
            alert('作品名不能大于6个字');
            return ;
        }
        $("#id_form_title").val(title);
		$('#form_1').submit();
		$('.page_loading').show();			
	})
	$(".but_img2").on('click',function(e){		
		//$('#form_1').submit();
		e.preventDefault();
		$('#id_box_2').show();
	})	
	var but_infobool=true;
	$('.but_info').on('touchend',function(e){
		e.preventDefault();
		var tel=$('#id_tel').val(),name=$('#id_name').val(),add=$('#id_add').val(),gid=$('#gid').val();
		if(!/^1[345789]\d{9}$/.test(tel)){
			alert('请正确输入手机号');
			return ;
		}
		if(name.length<2){
			alert('请正确输入姓名');
			return;
		}
		if(add.length<2){
			alert('请正确输入地址');
			return ;
		}
		but_infobool=false;
		Main.get('TyRyBottleInChina/WxTurntable/phone',{tel:tel,name:name,address:add,gid:gid},function(res){
            if(res.err == 0){
                alert('填写成功');
                location.href=Main.url+'TyRyBottleInChina/Wx/worklist';
            }else{
                alert(res.message);
            }
		})
	})
	var tab_0=$(".tab_0")
	$(".ul_nav1").on('touchend','li',function(e){
		e.preventDefault();
		$(this).parent().find('li').removeClass('current');
		$(this).addClass('current');
		$(".tab_0").css('display','none').eq($(this).index()).css('display','block')
	})
	$('.p_page_1').on('click','span',function(e){
		e.preventDefault();
		var index=$(this).index();
		var div=$(this).parents('.tab_0').find("div");
		$(this).parent().find('span').removeClass('current');
		$(this).addClass('current');
		div.css('display','none');
		div.eq(index).css('display','block')
	})
	$('.but_tou').on('touchend',function(e){
		e.preventDefault();
		var id=$(this).data('id');
		var piao=$(this).parent().find('.piao');
		Main.get('TyRyBottleInChina/WxInterface/votework',{wid:id},function(res){
            if(res.err==0){
                piao.html(res.piao);
                if(res.chou==1){
                    $('.div_chou').show();
                    $('.img_b2').attr("data-id",id)
                }else{
                    alert('投票成功!');
                    location=location;
                }
            }else{
                alert(res.message);
            }
		})
	})	
	$('.img_b2').on('touchend',function(e){
		e.preventDefault();
        Main.get('TyRyBottleInChina/WxTurntable/turntlottery',{wid:$(this).data('id')},function(res){

            var deg=res.rotate;
            $(".img_b1").css({rotate:deg+'deg'})
            setTimeout(function(){
                if(res.err == 1) {
                    alert(res.message);
                }else{
                    if (res.err == 0) {//未中
                        $('.p2').html('谢谢参与')
                        $('.p3,.img_post1').hide();
                        $('#id_con').show();
                    } else {
                        if (res.err == 2) {
                            $('.p2').html(res.title);
                            $('.p3').html(res.code);
                            $('#id_con').show();
                            var url = Main.url + 'TyRyBottleInChina/Wx/myinfo/id/' + res.id;
                            $('.img_post1').attr('data-url', url);
                            $('.img_post1').show();
                        }
                    }
                }
            },2200)

        })
	})
	$(".img_prev").on('touchend',function(e){
		e.preventDefault();
		$(".div_chou").hide();
        location=location;
	})
	$(".but_sina").on('touchend',function(e){
		e.preventDefault();
		$(".page_f").show();
	})
	$('.f_prev').on('touchend',function(e){
		e.preventDefault();
		$(".page_f").hide();
	})
	$(".ul_c").on('click','li',function(e){
		e.preventDefault();
		$(this).parent().find('li').removeClass('current');
		$(this).addClass('current');
		$(".img_d2").hide().eq($(this).index()).show();
	})
	$('.imgcan_1').on('touchend',function(e){
		e.preventDefault();
		var index=$(this).index();		
		$(".box_con1b").eq(index).show();
	})
	//手机验证
	//if(!/^1[34589]\d{9}$/.test(tel))
}

$(function(){
	Main.init();	
	
	if($('#id_canvas1').length>0){
		//window.canvas1=Main.canvas1=new Main.canvasFn();
	}	
	if($('#file_upload_1').length>0){
		window.canvas2=Main.canvas2=new Main.canvas2FN();
		$(document.body).on('touchmove',function(e){
		    e.preventDefault?e.preventDefault():window.event.returnValue = false; 	
	    })	
	}	
	if($('#id_canvas3').length>0){
		window.canvas3=Main.canvas3=new Main.canvas3FN();
		$(document.body).on('touchmove',function(e){
		    e.preventDefault?e.preventDefault():window.event.returnValue = false; 	
	    })	
	}
	setTimeout(function(){
		$('.page_index').addClass('current');
	},1000)
})
Main.canvas3FN=function(){	
	var fileLocation = '/Public/TyRyBottleInChina/Wx/build/zrender';
            require.config({
                paths:{ 
                    zrender: fileLocation,
                    'zrender/shape/Rose': fileLocation,
                    'zrender/shape/Trochoid': fileLocation,
                    'zrender/shape/Circle': fileLocation,
                    'zrender/shape/Sector': fileLocation,
                    'zrender/shape/Ring': fileLocation,
                    'zrender/shape/Ellipse': fileLocation,
                    'zrender/shape/Rectangle': fileLocation,
                    'zrender/shape/Text': fileLocation,
                    'zrender/shape/Heart': fileLocation,
                    'zrender/shape/Droplet': fileLocation,
                    'zrender/shape/Line': fileLocation,
                    'zrender/shape/Image': fileLocation,
                    'zrender/shape/Star': fileLocation,
                    'zrender/shape/Isogon': fileLocation,
                    'zrender/shape/BezierCurve': fileLocation,
                    'zrender/shape/Polyline': fileLocation,
                    'zrender/shape/Path': fileLocation,
                    'zrender/shape/Polygon': fileLocation,
                    'zrender/shape/Layer': '/Public/TyRyBottleInChina/Wx/src/Layer'
                }
    });
    var that=this;
    var current_selected;
    this.imgarr=[];
    require(['zrender','zrender/shape/Text','zrender/shape/Image','zrender/shape/Layer'],function(zrender,TextShape,ImageShape,layer){
    	 var zr = zrender.init(document.getElementById('id_canvas3'));
         var zrColor = require('zrender/tool/color');
         var width = Math.ceil(zr.getWidth());
         var height = Math.ceil(zr.getHeight());
         var img_21b=$(".img_21b");         
         zr.on('mouseup',function(){
         	img_21b.show();    
         })
         that.save=function(){
      	     var base=zr.toDataURL('images/png','#fff')
      	     $("#id_base64").val(base);
      	     $("#id_arr").val(that.getarrstring());
      	     return base;      	     
         }
         that.addimg=function(img,type,id,x,y,bool){
         	var url=new Image();
         	//url.setAttribute('crossOrigin', 'anonymous');
         	url.src=img;
         	var w=0;
         	url.onload=load;
         	function load(){
         		console.log(url.width,url.height)
         		var image = new ImageShape({
      	         	id : type+'_'+id,
      	         	z:type,
      	         	hoverable:bool,
                 	style: {
                    	image: img || 'a4_07.png',
                     	x: x || 0,
                     	y: y || 0 ,
                     	width:url.width/2.8125,
                     	height:url.height/2.8125
                 	},draggable:bool || false,
                 	onmousedown:function(params){
        	        	img_21b.hide();
        	        	//<-------2015/05/31
        	        	zr.storage.iterShape(function(shape){
        	        		shape.style.shadowBlur = 0;
        	        		shape.style.shadowColor="#ffffff";
        	        		shape.style.shadowOffsetX=0;
        	        		shape.style.shadowOffsetY=0;
        	        	},{});
        	        	zr.render();  
        	        	if(type==1){
        	        		current_selected=null; 
        	        		$("#scale_text").text("100%");
        	        		return;
        	        	}
        	        	current_selected = this;
        	        	this.style.shadowBlur = 5;
        	        	this.style.shadowColor="#ffffff";
        	        	this.style.shadowOffsetX=2;
        	        	this.style.shadowOffsetY=2;
        	        	$("#scale_text").text((this.scale[0]*100).toFixed(0)+"%");
        	        	zr.render();  
        	        	//-------->      	        	
                 	},
                 	ondragend:function(params){        		
                 		that.setarr(params.target.id,params.target.position[0],params.target.position[1])
                 	    //console.log(params.target.style)
                	}
               	});
                //<-------2015/05/31
				if(type != 1){
					current_selected = image;
					$("#scale_down_bt").off();
					$("#scale_up_bt").off();					
			         $("#scale_down_bt").click(function(){
			             console.log(current_selected.scale);
			             current_selected.scale=[current_selected.scale[0]>0.3?current_selected.scale[0]-0.2:current_selected.scale[0],current_selected.scale[0]>0.3?current_selected.scale[0]-0.2:current_selected.scale[0],current_selected.style.width/2,current_selected.style.height/2];       
			             zr.render();
			             $(this).siblings("#scale_text").text((current_selected.scale[0]*100).toFixed(0)+"%");
			             that.saveScale(current_selected.id,current_selected.scale[0].toFixed(1));
			             that.setarr(current_selected.id,current_selected.position[0]+(1-current_selected.scale[0].toFixed(1))*current_selected.style.width/2,current_selected.position[1]+(1-current_selected.scale[0].toFixed(1))*current_selected.style.height/2);
			             console.log(current_selected.style.width,current_selected.position[0]+(1-current_selected.scale[0].toFixed(1))*current_selected.style.width/2)
			         });

			         $("#scale_up_bt").click(function(){
			             current_selected.scale=[current_selected.scale[0]<1?current_selected.scale[0]+0.2:current_selected.scale[0],current_selected.scale[0]<1?current_selected.scale[0]+0.2:current_selected.scale[0],current_selected.style.width/2,current_selected.style.height/2];
			             zr.render();
			             $(this).siblings("#scale_text").text((current_selected.scale[0]*100).toFixed(0)+"%");
			             //console.log(zr);
			             that.saveScale(current_selected.id,current_selected.scale[0].toFixed(1));
			             that.setarr(current_selected.id,current_selected.position[0],current_selected.position[1]);
			             that.setarr(current_selected.id,current_selected.position[0]+(1-current_selected.scale[0].toFixed(1))*current_selected.style.width/2,current_selected.position[1]+(1-current_selected.scale[0].toFixed(1))*current_selected.style.height/2);
			             console.log(current_selected.style.width,current_selected.position[0]+(1-current_selected.scale[0].toFixed(1))*current_selected.style.width/2)
			         });
		        }
				//------->
            	zr.addShape(image)
            	zr.refresh();
         	}

         }
         that.removeimg=function(id){
         	zr.delShape(id);  
         	that.deletearr(id);
         	zr.refresh();  
         }
         //<------2015/05/31
         that.saveScale = function(id,scale){
            for(var i=0;i<that.imgarr.length;i++){
                if(that.imgarr[i].id==id){
                    that.imgarr[i].scale = scale;
                    //return ;
                }
            }
        }

         //------->

    });
    $('.tab_0').on('click','img',function(e){
    	e.preventDefault();
    	var current_img = this;
    	var src=$(this).data('src'),type=$(this).data('type'),id=$(this).data('id');
    	//如果点击右侧场景图片
        if(type == 1) {
            $.each($('.tab_1 img'),function(){
                if($(this).hasClass('current')&& this!= current_img){
                    that.removeimg(type+'_'+id);
                    $(this).removeClass('current');
                }
            });
        }

        if($(this).hasClass('current')){
            that.removeimg(type+'_'+id);
            $(this).removeClass('current');
            $(this).prev().remove();
        }else{
            that.addimg(src,type,id,0,0,type==1?false:true);
            $(this).addClass('current');
            that.imgarr.push({id:type+'_'+id,x:0,y:0,scale:1});
        }


    	// if($(this).hasClass('current')){
    	// 	that.removeimg(type+'_'+id);
    	// 	$(this).removeClass('current');
    	// }else{    		
    	// 	that.addimg(src,type,id,0,0,type==1?false:true);
    	// 	$(this).addClass('current');
    	// 	that.imgarr.push({id:type+'_'+id,x:0,y:0,scale:1});
    	// }
    	$('.box_con1b').hide()
    })    
    this.deletearr=function(id){
    	var index;
    	for(var i=0;i<that.imgarr.length;i++){
    		if(that.imgarr[i].id==id){
    			index=i;
    			//return ;
    		}
    	}
    	if(index>=0){
    		that.imgarr.splice(index,1);
    		//console.log(that.imgarr);
    	}
    }
    this.setarr=function(id,x,y){
    	for(var i=0;i<that.imgarr.length;i++){
    		if(that.imgarr[i].id==id){
    			that.imgarr[i].x=x;
    			that.imgarr[i].y=y;
    			//console.log(that.imgarr[i])
    		}
    	}
    	
    }
    this.getarrstring=function(){
    	var txt='';
    	for(var i=0;i<that.imgarr.length;i++){
    		console.log(that.imgarr[i].scale);
    		//if(that.imgarr[i].scale==1)that.imgarr[i].scale=0.9;
    		txt+=that.imgarr[i].id+':'+that.imgarr[i].x+'&'+that.imgarr[i].y+'$'+that.imgarr[i].scale+'@';
    	}
    	return txt;
    }
    this.post=function(call){
    	that.save()    	

		Main.post('/TyRyBottleInChina/WxInterfaceImage/preview',{base:$("#id_base64").val(),arr:$("#id_arr").val(),type:3},function(res){
			
			var url=res.img;
			call && call(res);
		})
	}
	$("#clear_canvas3").on('click',function(){
		while(that.imgarr.length>0){
			that.removeimg(that.imgarr[0].id);
		}		
	})
	
	//添加缩放
	// var options = {
	//     element: document.getElementById('id_canvas3'),
	//     currentScale: 1,
	//     minScale: 0.1,
	//     maxScale: 1,
	//     easing: 0.8,
	//     isParentScale:false,
	//     isDragable:true,
	//     callback: function(settings) {
	//     //returns settings object for the element 60 frames per second
	//     }
	// }

	// much.add(options);
	// much.setCallback(function(scale){
	// 	$("#test").text(scale);
	// 	    current_selected.scale = [scale,scale,current_selected.style.width/2,shape.style.height/2];;
	// 		//$("#file_upload_1").text(scale);
	// 		//$("#test").text(scale);

	// });
}
Main.canvas2FN=function(){
	var that=this;
	this.id_file=$("#id_file");
	this.drag_map=$("#drag_map");
	this.bool=false;
	this.scale = 100;
	ie=navigator.userAgent.indexOf('Android')>-1;	
	
	
	function uploadid(){
		var i=0,length=weixin.images.localId.length,data=[];
		i=length-1;
		wx.uploadImage({
				localId:weixin.images.localId[i],
				isShowProgressTips:0,
				success:function(res){
					weixin.images.serverId.push(res.serverId);//返回的是服务器图片的id
					//alert(res.serverId);
					$('#id_base64').val(res.serverId);
					Main.post('/TyRyBottleInChina/WxInterfaceImage/wxupload',{base:res.serverId},function(res){
						var img=new Image();
						img.src=res.src;
						//alert(res.src,res.width,res.height);
						img.onload=function(){
							that.upimg(img.src,res.width/2.8125,res.height/2.8125);
        					//weixin.uploadImage();        			
						}	
						$('.page_loading').hide();
					});
				},fail:function(res){
					console.log(JSON.stringify(res));
				}
		})
	}
	//ie=true;
	if( ie==true){
		that.id_file.hide();
		$("#file_upload_1").on('touchend',function(){	
			$(".page_loading").show();		
			wx.chooseImage({
              success: function (res) {           	 
           	      weixin.images.localId=res.localIds;// 保存本地图片的id 由 微信提供的  数组中的内容可以直接赋值到src    微信会去解析地址显示成图片           	      
           	      uploadid(); 
              }
            });
			return ;
			
			weixin.chooseImage(function(res){
				//alert(res.localIds.length)
				var img=new Image();
				img.src=res.localIds[res.localIds.length-1];
				img.onload=function(){
					that.upimg(img.src,img.naturalWidth/2.8125,img.naturalHeight/2.8125)
        			weixin.uploadImage();
        			//alert($('img').attr('src'))
				}				
				//for(var i=0;i<res.localIds.length;i++){
           	 	  // var img=$('<img src='+res.localIds[i]+'  style="width:30px;" id="id_img_'+i+'">')
           	 	   //$('body').append(img);           	 	
           	   // }
			});
		})
		/*
		$("#file_upload_1").uploadify({
		    height        : 36,
		    swf           : '/Public/TyRyBottleInChina/Wx/js/uploadify.swf',
		    uploader      : '/Public/TyRyBottleInChina/WxInterfaceImage/uploadify',
		   // 'buttonImg':'/js/b6_03.jpg',
		    buttonText:'     ',
		    width         : 100,		  
		    multi :false,
		    auto :true,
		    fileExt :'*.jpg,*.png,*.gif,*.jpeg' ,
		    onUploadSuccess:function(file,data,response){
		    	if(response.err==0){
		    		that.upimg(response.src,response.width/3,response.height/3)
        		    $('#id_base64').val(response.src)
		    	}else{
		    		alert(response.message)
		    	}		    	
		    }		    
	    });*/
	}
	this.id_file.on('change',function(){		
		//console.log($(this).get(0).value);
		//if(ie=true){
			//that.ieupload();
		//}else{
			that.upload();
		//}
		
	})	
	this.ieupload=function(){
		
	}
	this.upload=function(){
		var oFile = document.getElementById('id_file').files[0];   
        var rFilter = /^(image\/bmp|image\/gif|image\/jpeg|image\/png|image\/tiff)$/i;
        if (! rFilter.test(oFile.type)) {              
	       alert('请正确选择图片')
           return;
        }
		var oImage = document.getElementById('id_file');
        var oReader = new FileReader();
        oReader.onload = function(e){
        	var img=new Image();
        	img.src = e.target.result;  
        	img.onload=function(){
        		//console.log(img.naturalWidth,img.naturalHeight)
        		if(img.naturalWidth<900 || img.naturalHeight<600){
        			alert('图片宽高不达标准，请选择大于900*600的图')
        			return;
        		} else{
        			that.upimg(img.src,img.naturalWidth/2.8125,img.naturalHeight/2.8125)
        			$('#id_base64').val(img.src);
        			$("#drag_map img").css({"width":"100%"},{"height":"auto"});
        			$("#upLoadPic_scale_bt").show();
        			$("#upLoad_scale_text").text("100");
        		}	
        	}
        }
        oReader.readAsDataURL(oFile);
	}
	this.upimg=function(src,w,h){
		//that.bool=true;
		//console.log(w,h)
		that.drag_map.css({width:'320px',height:'213px',left:'0px',top:'-0px'})
		that.drag_map.find('img').attr('src',src).css({width:w+'px',height:h+'px'})
		var w1=w-320,h1=h-213;
		console.log(w1,h1)
		if(that.bool==true){
			that.drag_map.udraggable('destroy')
		}		
		that.drag_map.udraggable({revert:true,containment: [ -w1, -h1, 200, 180]});
        that.bool=true;
	}
	$("#upLoad_scale_down").click(function(){
	    var scale = parseInt($("#upLoad_scale_text").text());
	    if(scale>20)scale -=20;
	    $("#drag_map img").css({"width":scale+"%"});
	    $("#upLoad_scale_text").text(scale);
	});

	$("#upLoad_scale_up").click(function(){
	    var scale = parseInt($("#upLoad_scale_text").text());
	    if(scale<100){
	    	scale +=20;
	    }else{
	    	//return;
	    }
	    $("#drag_map img").css({"width":scale+"%"});
	    $("#upLoad_scale_text").text(scale);
	});
    var cur_imgbool=true;
	$(".cur_img").on('touchend',function(){
        /*
		$('.cur_img').removeClass('current');
		$(this).addClass('current');
		$('#drag_map').find('img').attr('class',$(this).data('class'));
		$('#id_class').val($(this).data('class'));*/
        var imgbase = $('#drag_map').find('img').attr('src');
        if(ie==true){
        	imgbase=$('#id_base64').val();
        }
        
        var filter = $(this).data('filter');
        if(imgbase.length<=0){
            alert('请先选择图片');
            return;
        }
        if(cur_imgbool==false){
            return;
        }

        cur_imgbool=false;
        $(".page_loading").show();
        Main.post(Main.url+'TyRyBottleInChina/WxInterfaceImage/filter',{base:imgbase,filter:filter},function(res){
            cur_imgbool=true;
            if(res.err==0){
                $('.cur_img').removeClass('current');
                $(this).addClass('current');
                $('#drag_map').find('img').attr('src',res.img);
                $('#id_base64').val(res.img)
            }else{
                alert(res.msg);
            }
            $(".page_loading").hide();
        })

	})
	this.getnumber=function(){
		var obj= {left:parseFloat($('#drag_map').css('left')),top:parseFloat($("#drag_map").css('top'))}
		$('#id_num').val(obj.left+','+obj.top)
	}
	this.post=function(call){
		//console.log(this.scale);
		//console.log("xy坐标："+$('#id_num').val());

		Main.post('/TyRyBottleInChina/WxInterfaceImage/preview',{base:$("#id_base64").val(),num:$("#id_num").val(),imgclass:$("#id_class").val(),type:2,scale:$('#upLoad_scale_text').html()},function(res){
			var url=res.img;
			call && call(res);
		})
	}
	$('#clear_canvas2').on('click',function(){
		$('#drag_map').find('img').attr('src','');		
	})

    //缩放
	// document.body.onselectstart = function (e) {
	//     e.preventDefault();
	//     return false;
	// };

	// var origin = document.querySelector("#map-container");
	// var drag_map = document.querySelector("#drag_map");
	// enableGestureEvents(origin,false);

	// var matrix;

	// origin.addEventListener("dualtouchstart",function(e){
	//     matrix = window.getComputedStyle(origin).webkitTransform;
	//     if(matrix == "none")
	//     {
	//         origin.style.webkitTransform = "scale(1)";
	//         matrix = window.getComputedStyle(origin).webkitTransform;
	//     }
	//     console.log(matrix);
	// },false);

	// origin.addEventListener("dualtouch",function(e){
	// 	$("#drag_map img").css({"width":(100-e.translate[0]).toFixed(1)+"%"});
	// 	$("#file_upload_1").text(100-e.translate[0]);
	//     //origin.style.webkitTransform = " matrix("+e.scale+",0,0,"+e.scale+","+e.translate[0].toFixed(1)+","+e.translate[1].toFixed(1)+") "+ matrix;
	//     //drag_map.style.webkitTransform = " matrix("+e.scale+",0,0,"+e.scale+","+e.translate[0].toFixed(1)+","+e.translate[1].toFixed(1)+") "+ matrix;

	// },false);
	// var element1 = new WKTouch(
	// 		'map-container', {
	// 		'dragable':true,
	// 		'scalable':true,
	// 		'rotatable': true,
	//     	'opacity':false
	// 	}).init();

   // var options = {
   //     element: document.getElementById('drag_map'),
   //     currentScale: 1,
   //     minScale: 0.1,
   //     maxScale: 1,
   //     easing: 0.8,
   //     isDragable:false,
   //     callback: function(settings) {
   //     //returns settings object for the element 60 frames per second
   //     }
   // }

   // much.add(options);
   // much.setCallback(function(scale){
   // 	    var t = scale*100;
   // 	    if(t>=100) t=100;
   // 	    if(t>=80&&t<100) t=80;
   // 	    if(t<80&&t>=60) t=60;
   // 	    if(t<60&&t>=40) t=40;
   // 	    if(t<40) t=20;
   // 	    that.scale= t;
   // 		//$("#file_upload_1").text(scale);
   // });
}
Main.canvasFn=function(){
	this.canvas=$("#id_canvas1");
	this.el=this.canvas.get(0);
	this.ctx=this.el.getContext('2d');
	this.width=5;
	this.color='#000';
	this.clearbool=false;
	this.clear=false;
	this.bool=true;
	this.x=this.y=0;
	this.x2=this.y2=0;
	this.top=this.canvas.offset().top;
	this.left=this.canvas.offset().left;
		var that=this;
	that.bool=false;
	this.img_21b=$(".img_21b")
	this.mousedown=function(event){
		if(that.clear==true){
			that.clearbool=true;
			that.bool=false;
		}else{
			that.clearbool=false;
			that.bool=true;
		}			
		that.img_21b.addClass('current');
		that.x= event.pageX - that.left;
		that.y= event.pageY - that.top;
	}
	this.mousemove=function(event){
		if(that.clearbool==true){
			that.x2=event.pageX - that.left;
			that.y2=event.pageY - that.top;
			that.ctx.beginPath();
			//console.log(that.x2,that.x,that.y2,that.y)
			that.ctx.clearRect(that.x2,that.y2,20,20);
		}else		if(that.bool==true){
			that.x2=event.pageX - that.left;
			that.y2=event.pageY - that.top;
			that.ctx.beginPath();
			//console.log(that.x2,that.y2);
			
			if(ie==true){
				//that.ctx.fillRect(100,100,20,20);
			}//else{
				that.ctx.moveTo(that.x,that.y);
				that.ctx.lineTo(that.x2,that.y2);
				that.ctx.strokeStyle=that.color;
				that.ctx.lineWidth=that.width;
				that.ctx.lineCap='round';
				that.ctx.stroke();
			//}
			
			that.x=that.x2;
			that.y=that.y2;
		}
	}
	this.up=function(event){
		that.bool=false;
		that.img_21b.removeClass('current');
	}
	this.el.addEventListener('mousedown',this.mousedown)
	this.el.addEventListener('mousemove',this.mousemove)
	this.el.addEventListener('mouseup',this.up);
	
	$(".ul_li1").on('click','img',function(){
		var color=$(this).data('color');
		console.log(color)
		that.color='#'+color;
		that.clear=false;
	})
	$(".ul_li2").on('click','li',function(){
		var w=$(this).width();
		that.width=w;
		that.clear=false;
	})
	$('.img_clear').on('click',function(){
		that.clear=true;
	})
	this.saveimg=function(){
		var base=that.el.toDataURL("image/png");	
		$('#id_base64').val(base);	
		return base;
	}
	this.post=function(call){
		Main.post('',{base:this.saveimg()},function(res){
			var url=res.img;
			call && call(res);
		})
	}
	$("#img_clear_canvas").on('click',function(){
		that.ctx.clearRect(0,0,that.canvas.width(),that.canvas.height());
	})
}

//zepto/jquery get
Main.get = function(url, data, success) {
	$.ajax({
		type : 'get',
		url : Main.url+url,
		dataType : 'jsonp',
		data : data,
		success : function(response) {
			console.log(response);
			if(response.err==99){
				location.href=response.url
				return ;
			}
			success(response);
		}
	})
}
/*
 * post 用于post大量数据不包括文件，执行后会返回数据
 * 如写成jsonp会默认为get方式，固服务器不需要接受callback
 *
 */
Main.post = function(url, obj, call) {
	if (!/^http/.test(url)) {
		url =url;
	}
	//call({img:'images/he_1.png'})
	$.post(url, obj, function(response) {
		//console.log(response);
		$('.page_loading').hide();			
		if (call) {
			call(response)
		}
	}, 'json')
}