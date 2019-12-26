function followWriter(e,id) {
	e.preventDefault();
	let data= {id};
	$.ajaxSetup({
		headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		url: "/users/follow",
		method: 'post',
		data,
		success: function(result){
			// $("main").prepend(`
			// <div class="alert alert-success">
			// 	${result.success}
			// </div>
			// `);
			const span = $('#follow');
			if(span.text() === 'unFollow'){
				span.text('Follow');
			}else{
				span.text('unFollow');
			}
			
			addNotification(result.success);
		}
	});
}

addNotification = (msg) => {
	let toast =$(`
	<div class="alert alert-success" style="display: none;">
		${msg}
	</div>
	`);
	$("main").prepend(toast);
	toast.slideDown();
	setTimeout(()=>{ toast.slideUp();}, 3000);
}

makeBreadcrumb = () => {

	var path = `<li class="breadcrumb-item"><A HREF="/">Main</A>`;
	// <li class="breadcrumb-item"><a href="#">Home</a></li>
	var href = document.location.href;
	var s = href.split("/");
	console.log(s);

	for (let j = 0; j < s.length; j++) {
console.log(href.substring(0,href.indexOf("/"+s[j])+s[j].length+1));
		
	}
	
	for (var i=3;i<(s.length-1);i++) {
		path+=`<li class="breadcrumb-item">
		 <A HREF="${href.substring(0,href.indexOf("/"+s[i])+s[i].length+1)}/">${s[i]}</A>
		 </li> `;
	}
	i=s.length-1;
	path+=`<li class="breadcrumb-item active" aria-current="page">
				${s[i]}
				</li>`;
	$('#breadcrumb').html(path);
}
makeBreadcrumb();
	
	