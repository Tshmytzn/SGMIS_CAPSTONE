function AdminLogin(route, dashboard) {
    document.getElementById("mainLoader").style.display = "flex";
    const formData = $("form#admin_login").serialize();

    $.ajax({
        type: "POST",
        url: route,
        data: formData,
        success: (r) => {
            document.getElementById("mainLoader").style.display = "none";
            alertify.set('notifier','position', 'bottom-left');
            if (r.status === "success") {
                window.location.href = dashboard;
            }else if(r.status === "incorrect"){
              alertify.error('Incorrect Password').dismissOthers(); 
            }else{
              alertify.error('Username Not Found').dismissOthers(); 
            }
            
        },
        error: (xhr) => {
            console.log(xhr.responseText);
        },
    });
}
