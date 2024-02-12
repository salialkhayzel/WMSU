

@include('student-components.student-navigation')

@include('student-components.student-navtabs')

<!-- Results Tab Content -->
<div role="tabpanel" class="tab-pane" id="results">
    <section class="results-section">
        <div class="container">
            <h2 class="section-title">Exam Results</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Exam</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CET Result</td>
                        <td>
                            <a href="path-to-cet-result-pdf.pdf" target="_blank" class="btn btn-primary">View</a>
                            <a href="path-to-cet-result-pdf.pdf" download class="btn btn-success">Download</a>
                        </td>
                    </tr>
                    <tr>
                        <td>NAT Result</td>
                        <td>
                            <a href="path-to-nat-result-pdf.pdf" target="_blank" class="btn btn-primary">View</a>
                            <a href="path-to-nat-result-pdf.pdf" download class="btn btn-success">Download</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Eat Result</td>
                        <td>
                            <a href="path-to-eat-result-pdf.pdf" target="_blank" class="btn btn-primary">View</a>
                            <a href="path-to-eat-result-pdf.pdf" download class="btn btn-success">Download</a>
                        </td>
                    </tr>
                    <!-- Add more exam result rows as needed -->
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Include Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

