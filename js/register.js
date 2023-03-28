const rules_for_signin = {
    email: {presence: true,email:true},
            password:{presence:true,length:{minimum:8,maximum:200}},
            repassword:{presence: true,length:{minimum:8,maximum:200},equality:"password"},
            first_name:{presence:true,length:{minimum:2,maximum:200}},
            last_name:{presence:true,length:{minimum:1,maximum:200}},
            mobile:{presence:true,numericality:{onlyInteger:true},length:{is:10}},
            age:{presence:true,numericality:{onlyInteger:true},}
};

document.getElementById("signup-form").addEventListener('submit',(e)=>{
    e.preventDefault();

    function clearErr(formFeild){
      for(let field of formFeild){
        document.getElementById("error-"+field).innerHTML="";
      }
    }

    function setErr(formField,errors){
      for(let field of formField){
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

  const formField = ['email','password','repassword','first_name','last_name','gender','mobile'];
  clearErr(formField);
  const values = validate.collectFormValues(e.target);
  const validated = validate(values,rules_for_signin);
  const data = new URLSearchParams(new FormData(e.target));
  if(validated===undefined){
      fetch("../php/register.php",{
            method:'POST',
            body:data
        }).then((res)=>res.json()).then(data=>{alert(data.message);
        if(data.success){
          window.location.replace("../html/login.html");
        }
      });
    }else{
        setErr(formField,validated);
    }
});



