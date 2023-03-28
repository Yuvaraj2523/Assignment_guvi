const rules_for_login = {
    email: {presence: true,email:true},
    password:{presence:true,length:{minimum:8,maximum:200}}
};

document.getElementById("login-form").addEventListener('submit',(e)=>{
    e.preventDefault();

    function clearErr(fields){
        for(let field of fields){
          document.getElementById("error-"+field).innerHTML="";
        }
      }
  
      function setErr(fields,errors){
        for(let field of fields){
          let errContent = '';
          if(errors[field]){
            errContent = '<ul>'
            for(let error of errors[field]){
                errContent+='<li>'+error+'</li>';
            }
            errContent+='</ul>';
          }
          document.getElementById("error-"+field).innerHTML = errContent;
  
        }
      }

      const fields = ['email','password'];

      clearErr(fields);

    const values = validate.collectFormValues(e.target);

    const validated = validate(values,rules_for_login);
    const data = new URLSearchParams(new FormData(e.target));
    if(validated===undefined){
        fetch("../php/login.php",{
            method:'POST',
            body:data
        }).then((res)=>res.json()).then(data=>{
            alert(data.message);
            if(data.success){
                window.location.replace("../html/profile.html");
            }
        });
    }else{
        setErr(fields,validated);
    }
});