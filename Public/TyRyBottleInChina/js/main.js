var Main = {	iscrolls : []};
Main.url = 'http://127.0.0.1/';//ajax请求地址cz.mengniu.sinreweb.com
Main.imgurl='http://127.0.0.1/Public/TyRyBottleInChina/'//加载图片请求地址
Main.worklist=0;
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
Main.setcanvas3d=function(res){
	console.log(res)	
	 var userAgent = navigator.userAgent; 
     var mac=userAgent.indexOf("Safari") > -1 && userAgent.indexOf("Chrome") < 1;
	//ie=1;
	if(Modernizr.canvas && !mac ){
		Main.imgbg=res.bigimg || 'images/testpic1.jpg';
        $("#if_frame_canvas").attr('src','/Public/TyRyBottleInChina/ruyin/index.html?v='+Math.random()*1000).show();
        $(".img_h1").hide();
	}else{
		$('.img_h1').attr('src',res.img)
	}
	$('.div_box_1').addClass('current');	
}
Main.On = function() {	
	$(".close_ma").on('click',function(){
		$(this).parent().parent().hide();
		clearInterval(interval);
	})
	$(".span_login").on('click',function(){
		$("#message_ma").show();
		polling();
	})
	$(".span_weixin").on('click',function(){
		$(".img_1").toggle();
	})
	$(".img_1").on('click',function(){
		$(this).toggle();
	})
	$('.ul_li1').on('mouseover','li',function(e){
		$(this).find('span').show();
	}).on('mouseout','li',function(){
		$(this).find('span').hide();
	})
	$('.box_1_close').on('click',function(){
		$('.div_box_1').removeClass('current');
	})
	$('.box_1_close2').on('click',function(){
		$("#box_jiang").hide();
		location.href='?v='+Math.random()*10000;
	})
	var but_1bool=true;
	$('.but_1').on('click',function(){
		var flag=$(this).data('flag');
        if(flag==0){
        	polling();
        	$("#message_ma").show();
        	return ;
        }
		var title=$(".input_1").val();
		if(title.length==0){
			alert('请正确填写作品名');
			return ;
		}
		if(title.length>6){
			 alert('作品名称不能大于6个字');
			return ;
		}
		if(but_1bool==false){
		    //alert('请不要重复提交');
		    return ;		
		}
		$(".span_zp_name").html(title);	
		$('#id_form_title').val(title);
        var scale=$('#upLoad_scale_text').html();
        $('#id_scale').val(scale); //设置缩放比例
		var type=$(this).data('type');
		if(type==1){//画图
			if(Main.canvas1.hua==false){
				alert("请先画图哦");
				return ;
			}			
			but_1bool=false;
			
			Main.canvas1.post(function(res){						
			    Main.setcanvas3d(res);	
			    but_1bool=true;	        
		    })
		}else if(type==2){//传图
			if($("#drag_map").find('img').attr('src').length<2){
				alert('请选择图片');
				return ;
			}
			but_1bool=false;
			Main.canvas2.getnumber();	
			Main.canvas2.post(function(res){
				Main.setcanvas3d(res);
				but_1bool=true;		
			});
		}	else {//拼图
			if(Main.canvas3.imgarr.length<1){
				alert('请还没有选择素材哦')
				return ;
			}
			but_1bool=false;
			Main.canvas3.post(function(res){
				but_1bool=true;
				Main.setcanvas3d(res);		
			})
		}			
	})
	$('.but_2').on('click',function(){
		 var flag=$(this).data('flag');
        if(flag==0){
        	polling();
        	$("#message_ma").show();
        	return ;
        }
		var title=$(".input_1").val();
		var type=$(this).data('type')
		if(title.length<2){
			alert('请正确填写作品名');
			return ;
		}
		if(title.length>6){
			 alert('作品名称不能大于6个字');
			return ;
		}
		
		$('#id_form_title').val(title);//设置form 作品名称
        var scale=$('#upLoad_scale_text').html();
        $('#id_scale').val(scale); //设置缩放比例
		if(type==1){
			Main.canvas1.saveimg();
		}else if(type==2){
			if($("#drag_map").find('img').attr('src').length<2){
				alert('请选择图片');
				return ;
			}
			Main.canvas2.getnumber()
		}else{
			if(Main.canvas3.imgarr.length<1){
				alert('请还没有选择素材哦')
				return ;
			}
			Main.canvas3.save()
		}		
		$('#form_1').submit();
		$(".page_loading").show();
	})
	$(".but_img1").on('click',function(){
		if(confirm('确定数据将会被清除')){			
			location.href='?v='+Math.random()*99999;
		}
	})
	$(".but_img2").on('click',function(){		
		$('#form_1').submit();
	})	
	var but_infobool=true;
	$('.but_info').on('click',function(){
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
		Main.get('TyRyBottleInChina/PcTurntable/phone',{tel:tel,name:name,address:add,gid:gid},function(res){
			if(res.err == 0){
                alert('提交成功');
                location.href=Main.url+'TyRyBottleInChina/Pc/worklist';
            }else{
                alert(res.message);
            }

		})
	})
    /*
	$('.but_img2').on('click',function(){
		location.href='post.html'
	})*/
	var tab_0=$(".tab_0")
	$(".ul_nav1").on('click','li',function(){
		$(this).parent().find('li').removeClass('current');
		$(this).addClass('current');
		$(".tab_0").css('display','none').eq($(this).index()).css('display','block')
	})
	$('.p_page_1').on('click','span',function(e){
		var index=$(this).index();
        var div=$(this).parents('.tab_0').find(".fenye"); //2015-5-29
		$(this).parent().find('span').removeClass('current');
		$(this).addClass('current');
		div.css('display','none');
		div.eq(index).css('display','block')
	})

    $('.span_touend').on('click',function(){
        var flag=$(this).data('flag');
        if(flag==0){
            polling();
            $("#message_ma").show();
            return ;
        }
    });

	$('.span_tou,.tou_cc').on('click',function(){
        var flag=$(this).data('flag');
        if(flag==0){
        	polling();
        	$("#message_ma").show();
        	return ;
        }
		var id=$(this).data('id');
		var piao=$(this).parent().find('.piao');
		Main.get('TyRyBottleInChina/PcInterface/votework',{wid:id},function(res){
			if(res.err==0){
				piao.html(res.piao);
				if(res.chou==1){
				    $('#box_jiang').show();
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
	$('.img_b2').on('click',function(){
		Main.get('TyRyBottleInChina/PcTurntable/turntlottery',{wid:$(this).data('id')},function(res){

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
                            var url = Main.url + 'TyRyBottleInChina/Pc/myinfo/id/' + res.id;
                            $('#id_jiang').attr('href', url);
                            $('.img_post1').show();
                        }
                    }
                }
			},2200)
			
		})
	})
	$('#id_box_1_color').on('click',function(){
		$(".div_box_1").removeClass('current');
	})
	//手机验证
	//if(!/^1[34589]\d{9}$/.test(tel))
}

$(function(){
	Main.init();	
	
	if($('#id_canvas1').length>0){
		window.canvas1=Main.canvas1=new Main.canvasFn();
	}
	if($('#file_upload_1').length>0){
		window.canvas2=Main.canvas2=new Main.canvas2FN();
	}	
	if($('#id_canvas3').length>0){
		window.canvas3=Main.canvas3=new Main.canvas3FN();
	}
	setTimeout(function(){
		$('.page_index').addClass('current');
	},1000)
})

Main.canvas3FN=function(){	
	var fileLocation = '/Public/TyRyBottleInChina/build/zrender';
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
                    'zrender/shape/Layer': '/Public/TyRyBottleInChina/src/Layer'
                }
    });
    var that=this;
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
        that.addimg=function(img,type,id,x,y,bool,z,target){
            var image = new ImageShape({
                id : type+'_'+id,
                z:z,
                hoverable:bool,
                style: {
                    image: img || 'a4_07.png',
                    x: x || 0,
                    y: y || 0
                },draggable:true,
                onmousedown:function(params){
                    console.log(this.id);
                    //if(type == 1) return;
                    img_21b.hide();

                },ondragend:function(params){
                    that.setarr(params.target.id,params.target.position[0],params.target.position[1])
                    //console.log(params.target.position)
                }

            });
            if(type == 1){
            	image.draggable = false;
            }
            if(type != 1){
                var shape = image;
                if($("#scaleDiv").length>0){
                    console.log("delete scale_div")
                    //$("#scaleDiv").remove();
                }

                //this.scale = [0.5,0.5,0.5,0.5];
                //var img = $('.tab_' + image.z + ' img').eq(parseInt(image.id.charAt(image.id.length - 1))-1);
                // console.log(img);
                console.log(target.position().left+"px");
                var scaleDiv = '<div class="scaleDiv" id = "scaleDiv_' +image.id+'" data-type="'+type+'" data-id="'+id+'"><button id="scale_down_bt" style="float:left;">-</button><span id="scale_text">'+(shape.scale[0]*100).toFixed(0)+'%</span><button id="scale_up_bt" style="float:right;">+</button></div>';
                $(scaleDiv).insertBefore(target);
                $("#scaleDiv_" +image.id).css({
                    "left": target.position().left+ 11 +"px",
                    "top": target.position().top+68+"px",
                    "display":"block",
                    "height":"21px"
                });

                $("#scaleDiv_"+image.id +" #scale_down_bt").click(function(){
                    console.log(shape.scale[0]);
                    shape = zr.storage.get($(this).parent().data('type')+'_'+$(this).parent().data('id'))
                    shape.scale=[shape.scale[0]>0.3?shape.scale[0]-0.2:shape.scale[0],shape.scale[0]>0.3?shape.scale[0]-0.2:shape.scale[0],shape.style.width/2,shape.style.height/2];
                    zr.render();
                    $(this).siblings("#scale_text").text((shape.scale[0]*100).toFixed(0)+"%");
                    console.log();
                    that.saveScale(imag.ied,shape.scale[0].toFixed(1));
                    that.setarr(current_selected.id,current_selected.position[0],current_selected.position[1]);
                    //zr.refresh();
                    //zrender.getInstance($(this).parent().data('type')+'_'+$(this).parent().data('id')).scale = [0.5,0.5,0.5,0.5];
                });

                $("#scaleDiv_"+image.id +" #scale_up_bt").click(function(){
                    console.log(shape.style);
                    shape = zr.storage.get($(this).parent().data('type')+'_'+$(this).parent().data('id'))
                    shape.scale=[shape.scale[0]<1?shape.scale[0]+0.2:shape.scale[0],shape.scale[0]<1?shape.scale[0]+0.2:shape.scale[0],shape.style.width/2,shape.style.height/2];
                    zr.render();
                    $(this).siblings("#scale_text").text((shape.scale[0]*100).toFixed(0)+"%");
                    console.log(zr);
                    that.saveScale(image.id,shape.scale[0].toFixed(1));
                    that.setarr(current_selected.id,current_selected.position[0],current_selected.position[1]);
                    //zr.refresh();
                    //zrender.getInstance($(this).parent().data('type')+'_'+$(this).parent().data('id')).scale = [0.5,0.5,0.5,0.5];
                });

            }

            zr.addShape(image)
            zr.render();
            console.log(zrender);
            zr.refresh();
        }
        that.removeimg=function(id){
            zr.delShape(id);
            that.deletearr(id);
            zr.refresh();
        }
        that.saveScale = function(id,scale){
            for(var i=0;i<that.imgarr.length;i++){
                if(that.imgarr[i].id==id){
                    that.imgarr[i].scale = scale;
                    //return ;
                }
            }
        }
    });
    $('.tab_0').on('click','img',function(){
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
            that.addimg(src,type,id,0,0,type==1?false:true,type,$(this));
            $(this).addClass('current');
            that.imgarr.push({id:type+'_'+id,x:0,y:0,scale:1});
        }
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
    		//console.log(that.imgarr[i].scale);
            txt+=that.imgarr[i].id+':'+that.imgarr[i].x+'&'+that.imgarr[i].y+'$'+that.imgarr[i].scale+'@';
    	}
    	return txt;
    }
    this.post=function(call){
    	that.save()    	
		Main.post(Main.url+'TyRyBottleInChina/PcInterfaceImage/preview',{base:$("#id_base64").val(),arr:$("#id_arr").val(),type:3},function(res){
			var url=res.img;
			call && call(res);
		})
	}
	$("#clear_canvas3").on('click',function(){
		while(that.imgarr.length>0){
			that.removeimg(that.imgarr[0].id);
		}		
	})
}
Main.canvas2FN=function(){
	var that=this;
	this.id_file=$("#id_file");
	this.drag_map=$("#drag_map");
	this.bool=false;
	//ie=true;
	if( ie==true){
		that.id_file.hide();
		$("#file_upload_1").uploadify({
		    height        : 28,
		    swf           : '/Public/TyRyBottleInChina/js/uploadify.swf',
		    uploader      : '/TyRyBottleInChina/PcInterfaceImage/uploadify',
		    'buttonImg':'/Public/TyRyBottleInChina/js/b6_03.jpg',
		    buttonText:'上传图片',
		    width         : 77,		  
		    multi :false,
		    auto :true,
		    fileExt :'*.jpg,*.png,*.gif,*.jpeg' ,
		    onUploadSuccess:function(file,data,response){
                var data=JSON.parse(data);
                if(data.err==0){
                    that.upimg(data.src,data.width,data.height)
                    $('#id_base64').val(data.src)
                }else{
                    alert(data.msg);
                }
		    }		    
	    });
	}
	this.id_file.on('change',function(){
		console.log('a')
		console.log($(this).get(0).value);
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
        		console.log(img.naturalWidth,img.naturalHeight)
        		if(img.naturalWidth<900 || img.naturalHeight<600){
        			alert('图片宽高不达标准，请选择大于900*600的图')
        			return ;
        		} else{
        			that.upimg(img.src,img.naturalWidth,img.naturalHeight)
        			$('#id_base64').val(img.src)
        		}
        		//$("#drag_map img").css({"width":"100%"},{"height":"auto"});
                $("#upLoadPic_scale_bt").show();
                $("#upLoad_scale_text").text("100");
        	}
        }
        oReader.readAsDataURL(oFile);
	}
	this.upimg=function(src,w,h){
		that.drag_map.css({width:w+'px',height:h+'px',left:'-100px',top:'-100px'})
		that.drag_map.find('img').attr('src',src).show();
		var w=w-900,h=h-600;
		console.log(w,h)
		if(that.bool==true){
			that.drag_map.udraggable('destroy')
		}
		that.drag_map.udraggable({
            containment: [ -w, -h, 500, 500]
        });
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
        if(scale<100)scale +=20;
        $("#drag_map img").css({"width":scale+"%"});
        $("#upLoad_scale_text").text(scale);
    });
    var ul_list_3bool=true;
	$(".ul_list_3").on('click','li',function(){
        /*
		$(this).parent().find('li').removeClass('current');
		$(this).addClass('current');
		$('#drag_map').find('img').attr('class',$(this).find('img').attr('class'))
		$('#id_class').val($(this).find('img').attr('class'))
		*/
        var imgbase = $('#drag_map').find('img').attr('src');
        var filter = $(this).find('img').data('filter');
        var thatul=$(this);
        if(imgbase.length<=0){
            alert('请先选择图片');
            return;
        }
        if(ul_list_3bool==false){
            return;
        }

        ul_list_3bool=false;
        Main.post(Main.url+'TyRyBottleInChina/PcInterfaceImage/filter',{base:imgbase,filter:filter},function(res){
            ul_list_3bool=true;
            if(res.err==0){
                thatul.parent().find('li').removeClass('current');
                thatul.addClass('current');
                $('#drag_map').find('img').attr('src',res.img);
                $('#id_base64').val(res.img)
            }else{
                alert(res.msg);
            }
        })
	})
	this.getnumber=function(){
		var obj= {left:parseFloat($('#drag_map').css('left')),top:parseFloat($("#drag_map").css('top'))}
		$('#id_num').val(obj.left+','+obj.top)
	}
	this.post=function(call){
		console.log($("#id_num").val());
		Main.post(Main.url+'TyRyBottleInChina/PcInterfaceImage/preview',{base:$("#id_base64").val(),num:$("#id_num").val(),imgclass:$("#id_class").val(),scale:$('#upLoad_scale_text').html(),type:2},function(res){
			var url=res.img;
			call && call(res);
		})
	}
	$('#clear_canvas2').on('click',function(){
		$('#drag_map').find('img').attr('src','');		
	})
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
	this.img_21b=$(".img_21b");
	this.hua=false;
	this.mousedown=function(event){
		that.top=that.canvas.offset().top;
		that.left=that.canvas.offset().left;
		if(that.clear==true){
			that.clearbool=true;
			that.bool=false;
		}else{
			that.clearbool=false;
			that.bool=true;
		}			
		//console.log('down'+that.clear);
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
			that.hua=true;
			that.x=that.x2;
			that.y=that.y2;
		}
	}
	this.up=function(event){
		that.bool=false;
		that.clear=false;
		that.clearbool=false;
		//console.log(that.clear)
		that.img_21b.removeClass('current');
	}
	
	this.el.addEventListener('mousedown',this.mousedown)
	this.el.addEventListener('mousemove',this.mousemove)
	this.el.addEventListener('mouseup',this.up);
	this.canvas.on('mouseout',this.up)
	
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
		Main.post(Main.url+'TyRyBottleInChina/PcInterfaceImage/preview',{base:this.saveimg(),type:1},function(res){
			var url=res.img;
			call && call(res);
		})
	}
	$("#img_clear_canvas").on('click',function(){
		that.hua=false;
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
	$('.page_loading').show();
	//call({img:'images/he_1.png'})
	$.post(url, obj, function(response) {
		//console.log(response);
		if (call) {
			call(response)
		}
		$(".page_loading").hide();
	}, 'json')
}