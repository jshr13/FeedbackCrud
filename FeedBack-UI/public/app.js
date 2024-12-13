const baseUrl = `${window.location.protocol}`;
$(document).ready(function () {
    const fetchFeedbacks = () => {
        axios.get('http://127.0.0.1:8000/feedbacks')
            .then(response => {
                console.log(response.data.data); // Debugging output
                const feedbackArray = response.data.data // Adjust based on the actual structure

                $('#feedbackList').html(''); // Clear existing feedbacks
                feedbackArray.forEach(feedback => {
                    const feedbackCard = `
                    <div class="card w-50 my-3 mx-auto">
                        <div class="card-body mx-auto" >
                            <p class="card-text text-center">
                                ${feedback.fd_textfd}
                            <p>
                            <div class="text-secondary mt-2 text-center">
                                <p><strong>${feedback.fd_name}</strong></p>
                                <p><strong>${feedback.created_at}</strong></p>
                                <button class="btn btn-sm btn-warning"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="editFeedback(${feedback.id})">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteFeedback(${feedback.id})">Delete</button>
                            </div>  
                        </div>
                    </div>`;
                    $('#feedbackList').append(feedbackCard);
                });
                
            })
            .catch(error => {
                console.error('Error fetching feedback:', error);
            });
    };

    const clearForm = () => {
        $('#action').val('0');
        $('#feedbackId').val('');
        $('#name').val('');
        $('#email').val('');
        $('#body').val('');
        $('#submitButton').text('Submit');
    };

    $('#feedbackForm').on('submit', function (e) {
        e.preventDefault();

        const data ={
                action: $('#action').val(),
                id: $('#feedbackId').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                body: $('#body').val(),
        }

        axios.post('http://127.0.0.1:8000/feedback/save', data)
            .then(() => {
                clearForm();
                fetchFeedbacks();
                window.location.href = '/feedPost'; 
            })
            .catch(error => {
                console.error('Error saving feedback:', error);
            });
    });

    window.editFeedback = (id) => {
        axios.get(`http://127.0.0.1:8000/feedback/${id}`)
            .then(response => {
                console.log(response.data.data);
                const feedback = response.data.data;
                $('#action').val('1');
                $('#feedbackId').val(feedback.id);
                $('#name').val(feedback.fd_name);
                $('#email').val(feedback.fd_email);
                $('#body').val(feedback.fd_textfd);
                $('#submitButton').text('Update');
            })
            .catch(error => {
                console.error('Error fetching feedback for edit:', error);
            });
    };

    window.deleteFeedback = (id) => {
        axios.delete(`http://127.0.0.1:8000/deleteFeedback/${id}`)
            .then(response => {
                console.log(response.data.data);
                const feedback = response.data.data;
                fetchFeedbacks();
            })
            .catch(error => {
                console.error('Error deleting feedback', error);
            });
    };
    clearForm();
    fetchFeedbacks();
});