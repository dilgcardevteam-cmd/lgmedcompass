
<x-app-layout>
<link rel="stylesheet" href="{{ asset('css/plus-jakarta-sans.css') }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
:root {
    --primary: #f59e0b;
    --text-main: #2D241E;
    --border-warm: #fef3c7;
    --border: #f6c76f;
    --card-shadow: 0 10px 25px rgba(120, 53, 15, 0.05);
}

/* 1. Reduce body padding and ensure no margin issues */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-main);
}

/* 2. Adjust container padding */
.container {
    max-width: 1300px;
    margin: auto;
    padding: 15px 20px 30px 20px; /* Reduced top padding to 15px */
    border-radius: 24px;
    border: 2px solid var(--border);
    box-shadow: var(--card-shadow);
}

.title {
    text-align: center;
    margin-bottom: 40px;
}

.title h1 {
    font-size: 36px;
    font-weight: 800;
    color: #000000;
    margin-bottom: 8px;
}

.title p {
    background: linear-gradient(135deg, #646464, #646464);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    font-size: 1rem;
    font-weight: 500;
    max-width: 900px;
    margin: auto;
}

/* 4. Fix potential gap if the Navigation component has margins */
header {
    margin-bottom: 0; 
}

/* Breadcrumb Styles */
.breadcrumb {
    font-size: 0.875rem;
    margin-bottom: 24px;
    display: none;
    align-items: center;
    gap: 8px;
    color: #7c5e3a;
    background: var(--primary-soft);
    padding: 8px 16px;
    border-radius: 12px;
}
.breadcrumb span { cursor: pointer; transition: 0.2s; }
.breadcrumb span:hover { color: var(--primary); font-weight: 600; }
.breadcrumb b { color: var(--primary); font-weight: 700; }
.breadcrumb i { font-size: 0.7rem; color: rgba(120,53,15,0.5); }

/* Division Cards */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    
}

.card {
    background: #fff;
    border: 2px solid var(--border-warm);
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    max-width: 320px;
    margin: auto;
}
.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 30px rgba(120,53,15,0.1);
    border-color: var(--primary);
}
.card-top {
    background: var(--primary-soft);
    padding: 40px;
    text-align: center;
}
.card-top img {
    width: 100px;
    display: block;
    margin: 0 auto;
}
.card-body {
    padding: 15px 20px;
}
.card-code {
    font-size: 13px;
    font-weight: 800;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.card-name {
    font-size: 16px;
    font-weight: 700;
    margin-top: 10px;
    line-height: 1.4;
}

/* Drive / Folder Styles */
.drive { 
    display: none; 
}
.back-btn {
    cursor: pointer;
    color: var(--primary);
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 25px;
    padding: 8px 16px;
    background: var(--primary-soft);
    border-radius: 12px;
}

.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.actions { display: flex; gap: 12px; flex-wrap: wrap; }
.btn-action {
    border: none;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: 0.3s;
    cursor: pointer;
}
.btn-folder { background: #fef3c7; color: #92400e; }
.btn-file { background: #f59e0b; color: #fff; }
.btn-link { background: #d97706; color: #fff; }

.table-wrapper {
    border: 2px solid var(--border-warm);
    border-radius: 20px;
    overflow: hidden;
    margin-top: 20px;
    display: none;
}

table { width: 100%; border-collapse: collapse; }
th { background: var(--primary-soft); color: #92400e; text-align: left; padding: 16px; font-size: 12px; font-weight: 800; border-bottom: 2px solid var(--border-warm); }
td { padding: 16px; background: white; border-bottom: 1px solid var(--border-warm); font-weight: 500; }
.badge-type { background: #fffbeb; color: #b45309; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }

/* File table action buttons */
.action-btns {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}
.action-eye, .action-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 18px;          /* reduced from 36px */
    width: 18px;           /* reduced from 36px */
    border-radius: 4px;    /* slightly smaller radius to match */
    font-size: 0.75rem;
    cursor: pointer;
    transition: 0.3s;
}
.action-eye {
    color: var(--primary);
    background: var(--primary-soft);
}
.action-eye:hover { background: #fef3c7; }
.action-delete {
    color: white;
    background: #ef6b6b;
}
.action-delete:hover { background: #d34848; }

/* Modern folder design */
.folder {
    background: #fff;
    padding: 16px 20px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    cursor: pointer;
    border: 1px solid var(--border-warm);
    transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    position: relative;
    max-width: 300px;
    min-width: 180px;
}
.folder:hover {
    transform: translateY(-8px);
    border-color: var(--primary);
    box-shadow: 0 12px 20px rgba(245, 158, 11, 0.25);
    background: #fff;
}
.folder-list {
    display: flex;
    flex-wrap: wrap;       /* Allows multiple rows */
    gap: 20px;             /* Space between folders */
    justify-content: flex-start; /* Align left, or center if you like */
}
.folder-icon-container { position: relative; z-index: 1; flex-shrink: 0; }
.folder-icon-container::after {
    content: '';
    position: absolute;
    inset: 0;
    background: #fbbf24;
    filter: blur(15px);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
    border-radius: 50%;
}
.folder:hover .folder-icon-container::after { opacity: 0.3; }
.folder i { font-size: 1.6rem; color: var(--primary); }
.folder div { font-weight: 600; font-size: 1rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

/* #goRootWrapper { margin-bottom:16px; display: none; } */
.btn-gold { background: #f59e0b; color:white; border:none; padding:10px 18px; border-radius:12px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:8px; }

/* Modals */
/* MODAL STYLING */
.modal {
    position: fixed;
    inset: 0;
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    opacity: 0;
    pointer-events: none;
    transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}

.modal.active {
    opacity: 1;
    pointer-events: auto;
}

.modal-content {
    background: white;
    padding: 32px;
    border-radius: 20px;
    width: 420px;
    max-width: 90%;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
    transform: scale(0.95);
    transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}

.modal.active .modal-content {
    transform: scale(1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 24px;
}

.modal-header i {
    cursor: pointer;
    font-size: 1.1rem;
    color: #7c5e3a;
    transition: 0.2s;
}
.modal-header i:hover {
    color: #f59e0b;
    transform: scale(1.1) rotate(15deg);
}

.modal input {
    width: 95%;
    padding: 12px 16px;
    margin-bottom: 16px;
    border-radius: 12px;
    border: 1.5px solid #fcd34d;
    font-size: 0.95rem;
    outline: none;
    transition: 0.2s;
}
.modal input:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 8px rgba(245,158,11,0.3);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 8px;
}

.modal-footer button {
    padding: 10px 20px;
    border-radius: 12px;
    border: none;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
}

.modal-footer .btn-cancel {
    background: #fefce8;
    color: #78350f;
}
.modal-footer .btn-cancel:hover {
    background: #fff7e5;
}

.modal-footer .btn-primary {
    background: linear-gradient(135deg, #fcd34d, #e7c85c);
    color: #1f1f1f;
}
.modal-footer .btn-primary:hover {
    background: linear-gradient(135deg, #ffd727, #ffe941);
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
}
/* DELETE MODAL DESIGN */

.delete-modal{
    text-align:center;
}

.delete-icon{
    font-size:48px;
    color:#ef4444;
    margin-bottom:15px;
    animation:popIn 0.4s ease;
}

.delete-title{
    font-size:22px;
    font-weight:800;
    margin-bottom:8px;
    color:#7f1d1d;
}

.delete-text{
    font-size:14px;
    color:#7c5e3a;
    margin-bottom:20px;
}

.btn-delete-confirm{
    background:#ef4444;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:12px;
    font-weight:700;
    cursor:pointer;
    transition:0.2s;
}

.btn-delete-confirm:hover{
    background:#dc2626;
    transform:translateY(-2px);
}

/* animation */

@keyframes popIn{
    0%{
        transform:scale(0.6);
        opacity:0;
    }
    100%{
        transform:scale(1);
        opacity:1;
    }
}
</style>
</head>


<body>
<div class="container">

<!-- Division Page -->
<div id="divisionPage">
    <div class="title">
        <h1>Programs, Projects & Activities</h1>
        <p>Select Section to view PPAs</p>
    </div>
    <div class="grid">
        <div class="card" onclick="openDivision(1)">
            <div class="card-top"><img src="{{ asset('images/dilg-logo.png') }}"></div>
            <div class="card-body">
                <div class="card-code">LGPCRDM</div>
                <div class="card-name">Local Government Performance, Compliance, Relations and Data Management</div>
            </div>
        </div>
        <div class="card" onclick="openDivision(2)">
            <div class="card-top"><img src="{{ asset('images/dilg-logo.png') }}"></div>
            <div class="card-body">
                <div class="card-code">LGCO</div>
                <div class="card-name">Local Government Community Operations</div>
            </div>
        </div>
        <div class="card" onclick="openDivision(3)">
            <div class="card-top"><img src="{{ asset('images/dilg-logo.png') }}"></div>
            <div class="card-body">
                <div class="card-code">LGPOPS</div>
                <div class="card-name">Local Government Peace and Order and Public Safety</div>
            </div>
        </div>
    </div>
</div>

<!-- Drive Page -->
<div id="drivePage" class="drive">
    <div class="back-btn" onclick="goBack()"><i class="bi bi-arrow-left"></i> Back to Divisions</div>
    

    <div class="header-row">
        <h2 id="divisionTitle" style="font-weight:800;font-size:28px;"></h2>
        <div class="actions">
            <button class="btn-action btn-folder" onclick="openModal('folderModal')"><i class="bi bi-folder-plus"></i> New Folder</button>
            <button class="btn-action btn-file" onclick="openModal('fileModal')"><i class="bi bi-upload"></i> Upload File</button>
            <button class="btn-action btn-link" onclick="openModal('linkModal')"><i class="bi bi-link-45deg"></i> Add Link</button>
        </div>
    </div>
    <div id="goRootWrapper">
        <button class="btn-gold" onclick="goRoot()"><i class="bi bi-house-door-fill"></i> My Drive</button>
    </div>

    <div class="breadcrumb" id="breadcrumb"></div>

    <div id="folderContainer" class="folder-list"></div>

    <div id="tableWrapper" class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>TYPE</th>
                    <th style="text-align:center;">ACTION</th>
                </tr>
            </thead>
            <tbody id="fileTable"></tbody>
        </table>
    </div>
</div>
</div>

<!-- Modals -->
<!-- FOLDER MODAL -->
<div class="modal" id="folderModal">
    <div class="modal-content">
        <div class="modal-header">
            Create Folder
            <i class="bi bi-x-lg" onclick="closeModal('folderModal')"></i>
        </div>
        <input type="text" id="folderName" placeholder="Enter folder name...">
        <div class="modal-footer">
            <button class="btn-primary" onclick="createFolder()">Create Folder</button>
        </div>
    </div>
</div>

<!-- FILE MODAL -->
<div class="modal" id="fileModal">
    <div class="modal-content">
        <div class="modal-header">
            Upload File
            <i class="bi bi-x-lg" onclick="closeModal('fileModal')"></i>
        </div>

        <!-- File Upload Area -->
        <div class="file-dropzone" onclick="document.getElementById('fileInputReal').click()">
            <i class="bi bi-cloud-upload" style="font-size:2.5rem; color:#f59e0b; margin-bottom:12px;"></i>
            <p style="margin-bottom:12px; font-weight:600; color:#92400e;">Choose file to upload</p>
            <button class="btn-primary" type="button">Choose File</button>
            <input type="file" id="fileInputReal" onchange="uploadFile()" style="display:none;">
            <p style="font-size:0.85rem; color:#7c5e3a; margin-top:12px;">
                Files will be added to the current folder
            </p>
        </div>
    </div>
</div>

<!-- LINK MODAL -->
<div class="modal" id="linkModal">
    <div class="modal-content">
        <div class="modal-header">
            Add Link
            <i class="bi bi-x-lg" onclick="closeModal('linkModal')"></i>
        </div>
        <input type="text" id="linkName" placeholder="Link Display Name">
        <input type="text" id="linkURL" placeholder="https://example.com">
        <div class="modal-footer">
            <button class="btn-primary" onclick="addLink()">Save Link</button>
        </div>
    </div>
</div>
<!-- DELETE CONFIRMATION MODAL -->
<div class="modal" id="deleteModal">
    <div class="modal-content delete-modal">

        <div class="delete-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

        <div class="delete-title">
            Delete File
        </div>

        <div class="delete-text">
            Are you sure you want to delete this file or link?  
            This action cannot be undone.
        </div>

        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal('deleteModal')">
                Cancel
            </button>

            <button class="btn-delete-confirm" onclick="confirmDelete()">
                Delete
            </button>
        </div>

    </div>
</div>

<script>
// =============================
// UPDATE BUTTON VISIBILITY
// Shows/hide file/link buttons and "My Drive" button based on folder level
// =============================
function updateActionButtonsVisibility() {
    const fileBtn = document.querySelector('.btn-file');
    const linkBtn = document.querySelector('.btn-link');
    const goRootWrapper = document.getElementById('goRootWrapper');

    if (currentFolderId === null) {
        // At division root: hide file & link buttons, hide "My Drive"
        if (fileBtn) fileBtn.style.display = 'none';
        if (linkBtn) linkBtn.style.display = 'none';
        if (goRootWrapper) goRootWrapper.style.display = 'none';
    } else {
        // Inside a folder: show file & link buttons, show "My Drive"
        if (fileBtn) fileBtn.style.display = 'flex';    // original display from .btn-action
        if (linkBtn) linkBtn.style.display = 'flex';
        if (goRootWrapper) goRootWrapper.style.display = 'block'; // or 'flex'
    }
}
function openDeleteFolderModal(folderId){
    deleteFolderId = folderId
    document.querySelector('.delete-title').innerText = "Delete Folder"
    document.querySelector('.delete-text').innerText = 
        "This will delete the folder and ALL its contents. This action cannot be undone."
    openModal('deleteModal')
}
/// =============================
// DRIVE STATE
// =============================
let currentDivisionId = null
let currentFolderId = null
let deleteFileId = null
let deleteFolderId = null
let folderPath = []

const divisionNames = {
    1: "LGPCRDM",
    2: "LGCO",
    3: "LGPOPS"
};

// =============================
// OPEN DIVISION
// =============================
function openDivision(divisionId){
    currentDivisionId = divisionId;
    currentFolderId = null;
    folderPath = [];                     // ✅ Clear the old path
    renderBreadcrumb();  
    updateActionButtonsVisibility();
    document.getElementById("divisionTitle").innerText = divisionNames[divisionId] || "Division";
    document.getElementById("divisionPage").style.display="none"
    document.getElementById("drivePage").style.display="block"

    loadFolders()

}


// =============================
// LOAD FOLDERS + FILES
// =============================
function loadFolders(){

fetch(`/drive/folders/${currentDivisionId}/${currentFolderId ?? ''}`)

.then(res=>res.json())

.then(data=>{

renderFolders(data.folders)
renderFiles(data.files)

})

}


// =============================
// RENDER FOLDERS
// =============================
function renderFolders(folders){

const container = document.getElementById("folderContainer")

container.innerHTML=""

folders.forEach(folder=>{

container.innerHTML += `
<div class="folder">

    <div style="display:flex; align-items:center; justify-content:space-between; width:100%;">

        <div style="display:flex; align-items:center; gap:14px; flex:1;"
             onclick="openFolder(${folder.id}, '${folder.name}')">

            <div class="folder-icon-container">
                <i class="bi bi-folder-fill"></i>
            </div>

            <div>${folder.name}</div>

        </div>

        <button class="action-delete" onclick="openDeleteFolderModal(${folder.id})">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
            </svg>
        </button>

    </div>

</div>
`

})

}

function renderBreadcrumb(){

    const breadcrumb = document.getElementById("breadcrumb")

    if(folderPath.length === 0){

    breadcrumb.style.display="none"
    return

    }

    breadcrumb.style.display="flex"

    let html = `<span onclick="goRoot()">My Drive</span>`

    folderPath.forEach((folder,index)=>{

    html += ` 
    <i class="bi bi-chevron-right"></i> 
    <span onclick="jumpToPath(${index})">${folder.name}</span>
    `

    })

    breadcrumb.innerHTML = html

}

function jumpToPath(index){

    const folder = folderPath[index]

    folderPath = folderPath.slice(0,index+1)

    currentFolderId = folder.id

    renderBreadcrumb()
    updateActionButtonsVisibility(); 
    loadFolders()

}

function goRoot(){

    folderPath = []

    currentFolderId = null

    renderBreadcrumb()
    updateActionButtonsVisibility(); 
    loadFolders()

}

const dropzone = document.querySelector(".file-dropzone")

    dropzone.addEventListener("dragover", (e)=>{

    e.preventDefault()

    dropzone.style.background="#fff7e5"

    })

    dropzone.addEventListener("dragleave", ()=>{

    dropzone.style.background=""

    })

    dropzone.addEventListener("drop",(e)=>{

    e.preventDefault()

    dropzone.style.background=""

    const file = e.dataTransfer.files[0]

    uploadDroppedFile(file)

})

function uploadDroppedFile(file){

    if(!currentFolderId){

    alert("Open a folder first")

    return

    }

    let form = new FormData()

    form.append('file',file)
    form.append('folder_id',currentFolderId)

    fetch('/drive/upload',{

    method:'POST',

    headers:{
    'X-CSRF-TOKEN':'{{ csrf_token() }}'
    },

    body:form

    })
    .then(()=>{

    loadFolders()

    })

}
function getFileIcon(name){

    const ext = name.split('.').pop().toLowerCase()

    if(ext==="pdf") return "bi-file-earmark-pdf-fill text-danger"

    if(["doc","docx"].includes(ext)) return "bi-file-earmark-word-fill text-primary"

    if(["xls","xlsx"].includes(ext)) return "bi-file-earmark-excel-fill text-success"

    if(["png","jpg","jpeg","gif"].includes(ext)) return "bi-file-earmark-image-fill text-warning"

    return "bi-file-earmark-fill"

}
// =============================
// OPEN FOLDER
// =============================
function openFolder(folderId, folderName){

folderPath.push({
    id: folderId,
    name: folderName
})

currentFolderId = folderId

renderBreadcrumb()
updateActionButtonsVisibility();
loadFolders()

}

function loadFolders() {
    let url = `/drive/folders/${currentDivisionId}`;
    if (currentFolderId) {
        url += `/${currentFolderId}`;
    }
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            renderFolders(data.folders);
            renderFiles(data.files);
        })
        .catch(error => {
            console.error('Error loading folders:', error);
            // Clear the UI to avoid showing stale data
            renderFolders([]);
            renderFiles([]);
        });
}
// =============================
// RENDER FILES
// =============================
function renderFiles(files){

const table = document.getElementById("fileTable")

table.innerHTML=""

if(!files || files.length===0){

document.getElementById("tableWrapper").style.display="none"
return

}

files.forEach(file=>{

table.innerHTML += `

<tr>

<td>
<i class="bi ${getFileIcon(file.name)}" style="margin-right:8px"></i>
${file.name}
</td>

<td>
<span class="badge-type">${file.type}</span>
</td>

<td>

<div class="action-btns">

<a href="${file.url}" target="_blank" class="action-eye">
<i class="bi bi-eye-fill"></i>
</a>

<button class="action-delete" onclick="openDeleteModal(${file.id})">
<i class="bi bi-trash-fill"></i>
</button>

</div>

</td>

</tr>

`

})

document.getElementById("tableWrapper").style.display="block"

}


// =============================
// CREATE FOLDER
// =============================
function createFolder(){

const name = document.getElementById('folderName').value

if(!name) return alert("Enter folder name")

fetch('/drive/folder',{

method:'POST',

headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':'{{ csrf_token() }}'
},

body:JSON.stringify({

name:name,
division_id:currentDivisionId,
parent_id:currentFolderId

})

})
.then(()=>{

document.getElementById("folderName").value=""

closeModal('folderModal')

loadFolders()

})

}


// =============================
// UPLOAD FILE
// =============================
function uploadFile(){

const file = document.getElementById("fileInputReal").files[0]

if(!file) return

if(!currentFolderId){

alert("Please open a folder first")

return

}

let form = new FormData()

form.append('file',file)
form.append('folder_id',currentFolderId)

fetch('/drive/upload',{

method:'POST',

headers:{
'X-CSRF-TOKEN':'{{ csrf_token() }}'
},

body:form

})
.then(()=>{

document.getElementById("fileInputReal").value=""

closeModal('fileModal')

loadFolders()

})

}


// =============================
// ADD LINK
// =============================
function addLink(){

const name = document.getElementById('linkName').value
const url = document.getElementById('linkURL').value

if(!name || !url){

alert("Fill all fields")

return

}

fetch('/drive/link',{

method:'POST',

headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':'{{ csrf_token() }}'
},

body:JSON.stringify({

name:name,
url:url,
folder_id:currentFolderId

})

})
.then(()=>{

document.getElementById("linkName").value=""
document.getElementById("linkURL").value=""

closeModal('linkModal')

loadFolders()

})

}


// =============================
// DELETE FILE
// =============================
function openDeleteModal(fileId){

deleteFileId = fileId

openModal('deleteModal')

}

function confirmDelete(){

    if(deleteFileId){
        fetch(`/drive/file/${deleteFileId}`,{
            method:'DELETE',
            headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        })
        .then(()=>{
            deleteFileId = null
            closeModal('deleteModal')
            loadFolders()
        })
    }

    else if(deleteFolderId){
        fetch(`/drive/folder/${deleteFolderId}`,{
            method:'DELETE',
            headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        })
        .then(()=>{
            deleteFolderId = null
            closeModal('deleteModal')
            loadFolders()
        })
    }

}
function closeModal(id){
    document.getElementById(id).classList.remove('active')

    // Reset delete modal text
    document.querySelector('.delete-title').innerText = "Delete File"
    document.querySelector('.delete-text').innerText = 
        "Are you sure you want to delete this file or link? This action cannot be undone."
}

// =============================
// NAVIGATION
// =============================
function goBack(){

document.getElementById("divisionPage").style.display="block"
document.getElementById("drivePage").style.display="none"

currentDivisionId=null
currentFolderId=null

}


// =============================
// MODALS
// =============================
function openModal(id){

document.getElementById(id).classList.add('active')

}

function closeModal(id){

document.getElementById(id).classList.remove('active')

}

</script>
</body>
</x-app-layout>
