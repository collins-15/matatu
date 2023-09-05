<?php include 'header.php'; ?>
<!-- Include jsPDF library -->

<!-- show number of customers, the generated income for each bus trip -->

  <body>
    <h1>Admin Report Generator</h1>
    <button id="generateReportButton">Generate Report</button>
    <a href="generate_pdf.php" target="_blank" id="pdfLink" style="display: none;">Generate PDF Report</a>

    <div id="reportContainer"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
      
     document.addEventListener("DOMContentLoaded", function () {
            const generateReportButton = document.getElementById("generateReportButton");
            const generatePDFButton = document.getElementById("generatePDFButton"); // Reference the "Generate PDF" button
            const reportContainer = document.getElementById("reportContainer");

            generateReportButton.addEventListener("click", function () {
                // Fetch and display the report data as before
                fetch("generate_report.php", {
                    method: "GET",
                })
                    .then((response) => response.json())
                    .then((data) => {
                        reportContainer.innerHTML = generateReportHTML(data);
                        // Show the PDF link after generating the report
                         pdfLink.style.display = "inline-block";
                    })
                    .catch((error) => {
                        console.error("Error generating report:", error);
                    });
            });
            function generateReportHTML(data, earningsData) {
    // Initialize the reportHTML string
    let reportHTML = "<h2>Generated Report on booked customers</h2>";

    // Table for booked customers
    if (data && data.length > 0) {
        reportHTML += "<table style='border-collapse: collapse; width: 100%;'>";
        reportHTML += "<tr style='background-color: #f2f2f2;'><th style='padding: 8px; border: 1px solid #ddd;'>Bus name</th><th style='padding: 8px; border: 1px solid #ddd;'>Reference Number</th><th style='padding: 8px; border: 1px solid #ddd;'>Passenger Name</th><th style='padding: 8px; border: 1px solid #ddd;'>Departure Location</th><th style='padding: 8px; border: 1px solid #ddd;'>Destination Location</th><th style='padding: 8px; border: 1px solid #ddd;'>Departure Time</th><th style='padding: 8px; border: 1px solid #ddd;'>Estimated Arrival</th><th style='padding: 8px; border: 1px solid #ddd;'>Price paid</th><th style='padding: 2px; border: 1px solid #ddd;'>Booked seats</th></tr>";

        data.forEach((row, index) => {
            const rowColor = index % 2 === 0 ? "#ffffff" : "#f2f2f2";
            reportHTML += `<tr style='background-color: ${rowColor};'><td style='padding: 8px; border: 1px solid #ddd;'>${row.Bus_Name}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Booking_Reference}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Passenger_Name}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Departure_Location}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Destination_Location}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Departure_Time}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Estimated_Arrival}</td>`;
            reportHTML += `<td style='padding: 8px; border: 1px solid #ddd;'>${row.Ticket_Price}</td>`;
            reportHTML += `<td style='padding: 2px; border: 1px solid #ddd;'>${row.booked_seats}</td></tr>`;
        });

        reportHTML += "</table>";
    } else {
        reportHTML += "<p>No booked customers data available.</p>";
    }

    return reportHTML;
}





      });
    </script>
  </body>
</html>
