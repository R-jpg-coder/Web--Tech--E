from django.shortcuts import render
from .forms import EmployeeForm
from .models import Employee

def Home(request):
    form=EmployeeForm()
    if request.method=='POST':
        form=EmployeeForm(request.POST)
        
        form.save
        form=EmployeeForm()
    data=Employee.objects.all()    
        
    context={
        'form':form,
        'data':data,
        
    }
    return render(request,'index.html',context)

# Create your views here.
