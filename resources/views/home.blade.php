@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chess</div>

                <div class="card-body text-center">

                    <canvas height="600" width="600" id="canvas"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjavascript')

    <script>

        class Point {
            constructor (x, y) {
                this.x = x;
                this.y = y;
            }
        }

        class Rectangle {
            constructor (point_bottom_left, point_top_right, fill = null, outline = 'black') {
                this.point_bottom_left = point_bottom_left;
                this.point_top_right = point_top_right;
                this.fill = fill;
                this.outline = outline;
            }

            draw (canvas_id) {
                let canvas = document.getElementById(canvas_id);
                let ctx = canvas.getContext('2d');
                if (canvas.getContext) {
                    ctx.beginPath();
                    ctx.moveTo(this.point_bottom_left.x, this.point_bottom_left.y);

                    ctx.lineTo(this.point_top_right.x, this.point_bottom_left.y); // Bottom Line
                    ctx.lineTo(this.point_top_right.x, this.point_top_right.y); // Right Line
                    ctx.lineTo(this.point_bottom_left.x, this.point_top_right.y); // Top Line
                    ctx.lineTo(this.point_bottom_left.x, this.point_bottom_left.y); // Left Line

                    if (this.fill) {
                        ctx.fillStyle = this.fill;
                        ctx.fill();
                    }

                    ctx.strokeStyle = this.outline;
                    ctx.stroke();
                }
            }
        }

        class Application {
            constructor () {
                this.canvas_size = 600;
                this.amount_of_squares = 8;
            }
        }

        class Board {
            constructor (application) {
                this.application = application;
                this.positions = Board.create_positions();
                this.five_percent = (this.application.canvas_size / 100) * 5;
                this.create_board()
            }

            static create_positions () {
                return {
                    1: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    2: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    3: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    4: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    5: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    6: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    7: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null},
                    8: {1: null, 2: null, 3: null, 4: null, 5: null, 6: null, 7: null, 8: null}
                }
            }

            create_board () {
                this.create_outline();
                this.create_squares();
            //     this.create_keys()
            //     this.create_pieces()
            }

            create_outline () {
                let canvas_95_percent = this.application.canvas_size - this.five_percent;

                let bottom_left_corner = new Point(this.five_percent, this.five_percent);
                let top_right_corner = new Point(canvas_95_percent, canvas_95_percent);

                let rectangle = new Rectangle(bottom_left_corner, top_right_corner);
                rectangle.draw('canvas');
            }

            create_squares () {
                let canvas_10_percent = this.five_percent * 2;
                let remaining_canvas_left = this.application.canvas_size - canvas_10_percent;

                let section_length = remaining_canvas_left / this.application.amount_of_squares;

                for (let i = 0; i < this.application.amount_of_squares; i++) {
                    let first_point_coord = (i * section_length) + this.five_percent;
                    let second_point_coord = ((i + 1) * section_length) + this.five_percent;

                    let bottom_left_corner = new Point(first_point_coord, this.five_percent);
                    let top_right_corner = new Point(second_point_coord, remaining_canvas_left + this.five_percent);
                    let line = new Rectangle(bottom_left_corner, top_right_corner);
                    line.draw('canvas')
                }

                for (let i = 0; i < this.application.amount_of_squares; i++) {
                    let first_point_coord = (i * section_length) + this.five_percent;
                    let second_point_coord = ((i + 1) * section_length) + this.five_percent;

                    let bottom_left_corner = new Point(this.five_percent, first_point_coord);
                    let top_right_corner = new Point(remaining_canvas_left + this.five_percent, second_point_coord);
                    let line = new Rectangle(bottom_left_corner, top_right_corner);
                    line.draw('canvas')
                }
            }
        }

        let application = new Application();
        let board = new Board(application);

    </script>

@endsection