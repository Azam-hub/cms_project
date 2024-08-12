
function printSlip(img_url, slip_no, gr_no, name, father_name, timing, course, purpose, fee_month, monthly_fee, balance, amount, date) {
    let html = `
    <div class="slip-container">
        <div class="slip">
            <div class="head">
                <div class="row align-items-center justify-content-evenly">
                    <div class="col-auto">
                        <img src="${img_url}" alt="Slip Logo">
                    </div>
                    <div class="col-auto">
                        <h1 class="m-0">SIMSAT</h1>
                    </div>
                </div>
                <div class="row justify-content-center pt-2">
                    <p class="m-0">TECHNICAL COLLEGE & COMPUTER ACADEMY</p>
                </div>
                <div class="row justify-content-center">
                    <p class="m-0">Affiliated by: SBTE</p>
                </div>
            </div>
            <div class="details mt-2">
                <div class="row fw-bold">
                    <div class="col-6 row justify-content-center">Fee Slip</div>
                    <div class="col-6 row justify-content-center">#${slip_no}</div>
                </div>
                <div class="personal-details my-2">
                    <div class="row my-1">
                        <div class="col-5">GR#</div>
                        <div class="col-7">${gr_no}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-5">Student Name:</div>
                        <div class="col-7">${name}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-5">Father's Name:</div>
                        <div class="col-7">${father_name}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-5">Timing:</div>
                        <div class="col-7">${timing}</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-5">Course:</div>
                        <div class="col-7">${course}</div>
                    </div>
                </div>
                <div class="fee-details">
                    <div class="row">
                        <div class="col row justify-content-center">
                            <p class="fw-bold my-0">Details</p>
                        </div>
                    </div>
                    <hr class="my-0 border border-dark  opacity-100">`;
                    if (purpose == "registration") {
                        html += `<div class="row my-1">
                                    <div class="col-5">Admission Fee:</div>
                                    <div class="col-7">${amount}</div>
                                </div>`;
                    } else if(purpose == "monthly") {
                        html += `<div class="row my-1">
                                    <div class="col-5">Fee Month:</div>
                                    <div class="col-7">${fee_month}</div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-5">Monthly Fee:</div>
                                    <div class="col-7">${monthly_fee}</div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-5">Balance:</div>
                                    <div class="col-7">${balance}</div>
                                </div>`;
                        
                    } else if(purpose == "examination") {
                        html += `<div class="row my-1">
                                    <div class="col-5">Examination Fee:</div>
                                    <div class="col-7">${amount}</div>
                                </div>`;
                    } else if(purpose == "certificate") {
                        html += `<div class="row my-1">
                                    <div class="col-5">Certificate Fee:</div>
                                    <div class="col-7">${amount}</div>
                                </div>`;
                    }
                    html += `<hr class="my-0 border border-dashed border-dark  opacity-100">
                    <div class="row my-1 fw-bold">
                        <div class="col-5">Total:</div>
                        <div class="col-7">${amount}</div>
                    </div>
                    <hr class="my-0 border border-dark  opacity-100">
                </div>
            </div>
            <div class="footer">
                <div class="row flex-column my-2">
                    <div class="col text-center"><b>NOTE: </b>Fees once deposited is not refundable or adjustable.</div>
                    ${purpose == "examination" ? 
                        `<div class="col text-center">Without Signature this receipt is not valid.</div>
                        <div class="col row">
                            <div class="col-4">
                                <b>Signature:</b>
                            </div>
                            <div class="col-8 p-5 border border-1 border-dark"></div>
                        </div>` : 
                        `<div class="col text-center">This is Computer Generated Slip not require Signature or Stamp.</div>`}
                    
                </div>
                <hr class="my-0 border border-dashed border-dark  opacity-100">
                <div class="row footer-details ">
                    <div class="col">
                        <div class="row">
                            <div class="col-4">Recp#</div>
                            <div class="col-8">${slip_no}</div>
                        </div>
                        <div class="row">
                            <div class="col-4">GR#</div>
                            <div class="col-8">${gr_no}</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Timing:</div>
                            <div class="col-8">${timing}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-4">Date:</div>
                            <div class="col-8">${date}</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Name:</div>
                            <div class="col-8">${name}</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Course:</div>
                            <div class="col-8">${course}</div>
                        </div>
                    </div>
                </div>
                <hr class="my-0 border border-dark  opacity-100">
                ${purpose == "monthly" ? `<div class="row">
                    <div class="col-7">Fee Month:</div>
                    <div class="col-5">${fee_month}</div>
                </div>` : ``}
                
                <div class="row fw-bold">
                    <div class="col-7">Total:</div>
                    <div class="col-5">${amount}</div>
                </div>
            </div>
        </div>
    </div>`;

    var contents = html;
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({ "position": "absolute", "top": "-1000000px" });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html><head><title>Fee Slip</title>');
    //Append the external CSS file.
    frameDoc.document.write(`
    <link href="../css/fee_slip.css" rel="stylesheet" type="text/css" /> 
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    `);
    frameDoc.document.write('</head><body>');
    //Append the DIV contents.
    frameDoc.document.write(`<div class="slip">${contents}</div>`);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);

    
}