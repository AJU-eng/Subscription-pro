 document.getElementById('schedule-element').addEventListener('click',(e)=>{
    e.preventDefault()

    let target=document.getElementById('elementTobe')
    target.classList.add('acws-salesDate-div')
 })

 document.getElementById('cancel-schedule').addEventListener('click',(e)=>{
    e.preventDefault()
    console.log('element clicked');
    
    let target=document.getElementById('elementTobe')
    console.log(target);
    
    target.classList.remove('acws-salesDate-div')

    console.log(target);
    
 })