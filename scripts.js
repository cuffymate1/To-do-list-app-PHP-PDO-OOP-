$(document).ready(function() {
    // การแก้ไข task
    $(document).on('click', '.edit-button', function() {
        var $task = $(this).closest('.task');
        $task.find('.progress').addClass('hidden');
        $task.find('.task-description').addClass('hidden');
        $task.find('.task-action').addClass('hidden');
        $task.find('.edit-task').removeClass('hidden');
    });

    // การคลิกที่ checkbox
    $(document).on('click', '.progress', function() {
        if ($(this).is(':checked')) {
            $(this).addClass('done');
        } else {
            $(this).removeClass('done');
        }
    });

    // เปลี่ยนแปลงใน checkbox
    $(document).on('change', '.progress', function() {
        const id = $(this).data('task-id'); // รับ id ของงาน
        const completed = $(this).is(':checked') ? 1 : 0; // ตรวจสอบสถานะ checkbox

        $.ajax({
            url: './actions/update-progress.php',
            method: 'POST',
            data: { id: id, completed: completed },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Task status updated successfully.');
                } else {
                    alert('Something went wrong');
                }
            },
            error: function(xhr, status, error) {
                alert('Error updating task status: ' + error);
            }
        });
    });
});
