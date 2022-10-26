<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentValidation;
use App\Models\Article;
use App\Models\Comment;

class ArticleController extends Controller
{

    public function index()
    {

        $articles = Article::paginate(20);

        return response()->json($articles, 200);
    }

    /**
     * @OA\Get(
     *      path="/articles/{id}",
     *      operationId="getArticleById",
     *      tags={"Articles"},
     *      summary="Get Article information",
     *      description="Returns article data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function getArticle($id)
    {

        $article = Article::with('comments')
            ->where('id', $id)
            ->first();

        if ($article) {
            return response()->json($article, 200);
        } else {
            return response([

                'message' => "No Record",
            ], 400);
        }

    }
    /**
     * @OA\Post(
     *  operationId="storeComment",
     *  summary="Insert a new Comment",
     *  description="Insert a new Comment",
     *  tags={"Comments"},
     *  path="/articles/id/comment",
     *  @OA\RequestBody(
     *    description="Comment to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="subject",
     *      property="subject",
     *      type="object",
     *     ),
     *  @OA\Property(
     *      title="body",
     *      property="body",
     *      type="object",
     *     )
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Book created",
     *     @OA\JsonContent(
     *
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param BookRequest $request
     * @return JsonResponse
     */

    public function addComment($id, CommentValidation $request)
    {
        $input = $request->validated();
        $input['article_id'] = $id;

        try {Comment::create($input);

            return response([

                'message' => "Your Message has been successfully sent",
            ], 201);} catch (\Exception$exception) {

            return response([

                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    /**
     * @OA\Get(
     *      path="/articles/{id}/like",
     *      operationId="getLikesById",
     *      tags={"Articles"},
     *      summary="Get No of Like information",
     *      description="Returns Number of Likes",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Return Likes",
     *@OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function getLikes($id)
    {

        $article = Article::where('id', $id)
            ->first();

        if ($article) {
            $article->likes += 1;
            $article->save();

            return response([

                'likes' => $article->likes,
            ], 200);
        } else {
            return response([

                'message' => "No Record",
            ], 400);
        }

    }

    /**
     * @OA\Get(
     *      path="/articles/{id}/view",
     *      operationId="getViewsById",
     *      tags={"Articles"},
     *      summary="Get No of Views",
     *      description="Returns Number of Views",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Return Views",
     *@OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function getViews($id)
    {

        $article = Article::where('id', $id)
            ->first();

        if ($article) {
            $article->views += 1;
            $article->save();
            return response([

                'likes' => $article->views,
            ], 200);
        } else {
            return response([

                'message' => "No Record",
            ], 400);
        }

    }
}
