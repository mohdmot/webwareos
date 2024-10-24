/*
plus_onclick() Function
  When someone click the (+) button
  The dropdown list will be displayed as "block"
  After 4 seconds it will dissapears.
*/
function plus_onclick() {
    document.getElementsByClassName('dropdown-list')[0].style['display']="block"
        setTimeout(()=>{
            document.getElementsByClassName('dropdown-list')[0].style['display']=""
        }, 4000)
} 


/*
openfile_dialog() Function
  Set the methods that you can open a specific file
*/
function openfile_dialog (path) {
    document.getElementById('openfile-dialog-iv').style['display']='none';
    document.getElementById('openfile-dialog').showModal()
    document.getElementById('openfile-dialog-dl').href = 'api/download.php?p='+path
    document.getElementById('openfile-dialog-fe').href = 'file_editor.php?p='+path
    filetype = path.split('.')
    filetype = filetype[ filetype.length - 1 ]
    if (['bmp','jpg','jpeg','gif','png','web','svg','webp','ico','apng','avif','jfif','pjpeg','pjp'].includes(filetype)) {
        console.log('Yes')
        document.getElementById('openfile-dialog-iv').style['display']='inline';
        document.getElementById('openfile-dialog-iv').onclick = ()=>{document.getElementById("image-viewer").showModal()}
        document.getElementById('image-viewer').querySelector('#showen-img').src = 'api/showimg.php?p='+path

    }
}


function show_details (th) {
    row = th.parentNode.parentNode.parentNode;
    console.log(row)
    fname = row.querySelector('.fname').innerHTML;
    fsize = row.querySelector('.fsize').innerHTML;
    fdate = row.querySelector('.fdate').innerHTML;
    full_text="<h3>File Name :</h3> " + fname + '<br><h3>File Size :</h3> ' + fsize + '<br><h3>Last Modified :</h3>' + fdate;
    document.getElementById('details-dialog').querySelector('#file-details').innerHTML = full_text;
    document.getElementById('details-dialog').showModal();
}
