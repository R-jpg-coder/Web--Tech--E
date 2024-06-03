package com.user.client;

import com.movie.dto.MessageDTO;
import com.movie.dto.MessageResponse;
import com.movie.dto.MovieDTO;
import com.movie.dto.MovieSearchCriteria;
import com.movie.dto.PostDTO;
import com.movie.entity.Movie;
import com.movie.entity.PostActivity;
import com.movie.entity.UserActivity;
import com.movie.entity.UserPost;
import org.springframework.cloud.openfeign.FeignClient;
import org.springframework.cloud.openfeign.SpringQueryMap;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.repository.query.Param;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;

import java.util.List;

@FeignClient(url = "http://localhost:8082", value = "MovieService")
//@RequestMapping("/api/movies")
public interface MovieClient {

  @GetMapping("/api/movies/all")
  ResponseEntity<Page<Movie>> listMovie(@SpringQueryMap Pageable pageable,@RequestParam("searchString") String criteria);

  @GetMapping("/api/movies/list")
  ResponseEntity<List<Movie>> getAllMoviesList();

  @GetMapping("/api/movies/sync")
  ResponseEntity<List<MovieDTO>> sync();

  @GetMapping("/api/movies/{id}")
  ResponseEntity<Movie> getMovieById(@PathVariable Long id);

  @PostMapping("/api/movies")
  Movie createMovie(@RequestBody MovieDTO movieDTO);

  @PutMapping("/api/movies/{id}")
  Movie updateMovie(@PathVariable Long id, @RequestBody MovieDTO movieDTO);

  @DeleteMapping("/api/movies/{id}")
  MessageResponse deleteMovie(@PathVariable Long id);


  @PostMapping("/like")
  ResponseEntity<String> likeMovie(@RequestParam Long userId, @RequestParam Long movieId);




  @PostMapping("/api/movies/watched/{userId}/{movieId}")
  ResponseEntity<String> watchedMovie(@PathVariable Long userId, @PathVariable Long movieId);

  @PostMapping("/api/movies/recommended/{userId}/{movieId}")
  ResponseEntity<String> recommendedMovie(@PathVariable Long userId, @PathVariable Long movieId);



  @PostMapping("/api/movies/rating/{userId}/{movieId}")
  ResponseEntity<String> rating(@PathVariable Long userId, @PathVariable Long movieId,@RequestBody MessageDTO messageDTO);

  @PostMapping("/api/movies/review/{userId}/{movieId}")
  ResponseEntity<String> review(@PathVariable Long userId, @PathVariable Long movieId,@RequestBody MessageDTO messageDTO);

  @PostMapping("/api/movies/pending/{userId}/{movieId}")
  ResponseEntity<String> pendingMovie(@PathVariable Long userId, @PathVariable Long movieId);

  @GetMapping("/api/movies/rating/{movieId}")
   ResponseEntity<List<UserActivity>> getUserActivityMovieById(@PathVariable Long movieId);



  @PostMapping("/rating")
  ResponseEntity<String> reviewMovie(
      @RequestParam Long userId, @RequestParam Long movieId, @RequestBody MessageDTO messageDTO);

  @PostMapping("/review")
  ResponseEntity<String> ratingMovie(
      @RequestParam Long userId, @RequestParam Long movieId, @RequestBody MessageDTO messageDTO);

  @PostMapping("/posts/create/{userId}")
   ResponseEntity<UserPost> createPost(@RequestBody PostDTO postDTO, @PathVariable Long userId) ;

  @PutMapping("/posts/update/{userId}/{id}")
  ResponseEntity<UserPost> updatePost(@RequestBody PostDTO postDTO, @PathVariable Long userId,@PathVariable Long id);


  @DeleteMapping("/posts/delete/{userId}/{id}")
  ResponseEntity<Void> deletePost(@PathVariable Long userId,@PathVariable Long id);

  @GetMapping("/posts/{userId}")
  ResponseEntity<List<UserPost>> getpostList(@PathVariable Long userId);

  @GetMapping("/posts/comments/{id}")
  ResponseEntity<List<MessageResponse>> commentsByPost( @PathVariable Long id);




  @PostMapping("/posts/share/{userId}/{id}")
  ResponseEntity<PostActivity> share(@PathVariable Long userId,
                            @PathVariable Long id,@RequestBody MessageDTO comment);

  @PostMapping("/posts/comment/{userId}/{id}")
  ResponseEntity<PostActivity> comment(@PathVariable Long userId,
                                     @PathVariable Long id,@RequestBody MessageDTO comment);

  @PostMapping("/posts/like/{userId}/{id}")
  ResponseEntity<PostActivity> like(@PathVariable Long userId,
                                       @PathVariable Long id);






}
