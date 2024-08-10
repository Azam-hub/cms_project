// $('#attendance-table').DataTable( {
//     data: data,
//     columns: [
//         { data: 'gr_no' },
//         { data: 'gr_no' },
//         { 
//             data: 'user.profile_pic',
//             render: function (data) {
//                 let img = `<a href="${window.location.origin}/storage/${data}" data-lightbox="profile-pic-">
//                                 <img src="${window.location.origin}/storage/${data}" width="100px" alt="Profile Pic">
//                             </a>`

//                 return img;
//             }

//         },
//         { data: 'user.name' },
//         { data: 'user.father_name' },
//         { data: 'course.name' },
//         { 
//             data: 'attendance',
//             render: function (data) {
//                 let attendance = false;
//                 if (data != null) {
//                     attendance = data.status
//                 }

//                 let status = "";
//                 if (attendance == "present") {
//                     status = `<div class="px-2 py-1 rounded-2 text-light text-center bg-success">Present</div>`
//                 } else if (attendance == "absent") {
//                     status = `<div class="px-2 py-1 rounded-2 text-light text-center bg-danger">Absent</div>`
//                 } else {
//                     status = `<div class="px-2 py-1 rounded-2 text-light text-center bg-warning">Not Marked</div>`                                        
//                 }

//                 return status;
//             }
//         },
//         { 
//             data: 'attendance',
//             render: function (data, type, row, meta, iDisplayIndex) {
//                 let attendance = false;
//                 if (data != null) {
//                     attendance = data.status
//                 }

//                 let btns = "";
//                 if (attendance == 'present') {
//                     btns = `<button class="btn btn-danger attendance-btn" data-student-id="${row.id}">Absent</button>`
//                 } else if (attendance == "absent") {
//                     btns = `<button class="btn btn-primary attendance-btn" data-student-id="${row.id}">Present</button>`
//                 } else {
//                     btns = `
//                         <button class="btn btn-primary attendance-btn" data-student-id="${row.id}">Present</button>
//                         <button class="btn btn-danger attendance-btn" data-student-id="${row.id}">Absent</button>`
//                 }

//                 return row;
//             } 
//         },
//         { 
//             data: 'created_at' ,
//             render: function (data) {
//                 return formatDateTime(data)
//             }
//         },
//     ]
// } );